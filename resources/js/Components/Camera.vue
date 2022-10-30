<script>
import {ArrowPathIcon, CameraIcon, CheckIcon, XMarkIcon} from '@heroicons/vue/24/outline';

export default {
    components: {
        CameraIcon,
        CheckIcon,
        XMarkIcon,
        ArrowPathIcon
    },
    props: {
        isOpen: Boolean
    },
    data() {
        return {
            videoDeviceIndex: null,
            videoDevices: [],
            isPhotoTaken: false,
            isShotPhoto: false,
            isLoading: false,
            error: false,
            link: '#'
        }
    },
    async mounted() {
        await this.setVideoDevices();
        this.selectRearVideoDevice();
        this.createCameraElement();
    },
    beforeUnmount() {
        this.stopCameraStream();
    },
    emits: [
        'close',
        'photo:taken'
    ],
    methods: {
        getCameraElementBounding() {
            return this.$refs.camera?.getBoundingClientRect();
        },
        getCameraStreamSettings() {
            return this.$refs.camera?.srcObject?.getVideoTracks()[0]?.getSettings();
        },
        async setVideoDevices() {
            this.videoDevices = (await navigator.mediaDevices.enumerateDevices()).filter(device => device.kind === "videoinput");
            this.videoDeviceIndex = 0;
        },
        selectRearVideoDevice() {
            const rearIndex = this.videoDevices.findIndex(device =>
                device.label && (device.label.includes('rear') || device.label.includes('back'))
            )

            if (rearIndex > -1) {
                this.videoDeviceIndex = rearIndex;
            }
        },
        selectNextVideoDevice() {
            if (this.videoDeviceIndex + 1 >= this.videoDevices.length) {
                this.videoDeviceIndex = 0;
            } else {
                this.videoDeviceIndex++;
            }

            this.stopCameraStream();
            this.createCameraElement();
        },
        getDeviceId() {
            if (!this.videoDeviceIndex) {
                return undefined;
            }
            const device = this.videoDevices[this.videoDeviceIndex];

            if (device.deviceId === "") {
                return undefined;
            }

            return {
                exact: device.deviceId
            }
        },
        createCameraElement() {
            this.isLoading = true;

            const constraints = (window.constraints = {
                audio: false,
                video: {
                    deviceId: this.getDeviceId()
                }
            });

            console.log(this.videoDevices);
            console.log(constraints)


            navigator.mediaDevices
                .getUserMedia(constraints)
                .then(stream => {
                    this.$refs.camera.srcObject = stream;
                })
                .catch(error => {
                    this.error = error;
                    console.error(error);
                })
                .finally(() => {
                    this.isLoading = false;
                })
        },
        stopCameraStream() {
            let tracks = this.$refs.camera.srcObject.getTracks();

            tracks.forEach(track => {
                track.stop();
            });
        },
        async takePhoto() {
            const camEl = this.getCameraElementBounding();
            const camStream = this.getCameraStreamSettings();

            this.isPhotoTaken = true;

            this.$refs.canvas.height = camEl.height;
            this.$refs.canvas.width = camEl.width;

            const context = this.$refs.canvas.getContext('2d');
            context.scale(-1, 1);
            context.drawImage(
                this.$refs.camera,
                (camStream.width - camEl.width) / 2, 0, camEl.width, camEl.height,
                0, 0, -camEl.width, camEl.height
            );
            context.scale(1, 1);

            await this.emitTakenPhoto();

            this.isPhotoTaken = false;
        },

        emitTakenPhoto() {
            return new Promise((resolve) => {
                document.getElementById("photoTaken").toBlob(image => {
                    this.$emit('photo:taken', image)
                    resolve();
                });
            })
        },
        close() {
            this.$emit('close');
        },
    }
}
</script>

<template>
    <div v-show="isOpen" class="">
        <div class="relative aspect-3/4 rounded-md bg-black">
            <div v-show="isLoading" class="aspect-3/4 object-cover rounded-md"></div>

            <video v-show="!(isPhotoTaken || isLoading)" ref="camera"
                   class="scale-x-mirror aspect-3/4 object-cover rounded-md"
                   autoplay></video>

            <canvas v-show="isPhotoTaken" class="w-full aspect-3/4" id="photoTaken" ref="canvas"></canvas>

            <div v-if="false" class="absolute w-full top-0 flex flex-row items-center justify-start p-4 gap-4">
                <button type="button" class="btn-icon-danger" @click="close">
                    <XMarkIcon class="h-6 w-6"/>
                </button>
            </div>

            <div class="absolute w-full bottom-0 flex flex-row items-end justify-center p-4 gap-4">
                <div v-show="error" class="text-red-600 bg-red-100 p-4 rounded-lg">
                    Impossible d'accéder à la caméra
                </div>
                <button type="button" class="btn-icon-danger p-2" @click="close">
                    <XMarkIcon class="h-5 w-5"/>
                </button>
                <button v-show="!error" type="button" class="btn-icon" @click="takePhoto">
                    <CameraIcon class="h-8 w-8"/>
                </button>
                <button v-show="!error" type="button" class="btn-icon p-2" v-if="videoDevices.length>0"
                        @click="selectNextVideoDevice">
                    <ArrowPathIcon class="h-5 w-5"/>
                </button>
            </div>
        </div>
    </div>
</template>
