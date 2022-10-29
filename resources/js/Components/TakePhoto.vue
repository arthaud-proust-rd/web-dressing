<script>
import {CameraIcon, CheckIcon, XMarkIcon} from '@heroicons/vue/24/outline';

export default {
    components: {
        CameraIcon,
        CheckIcon,
        XMarkIcon
    },
    props: {
        isOpen: Boolean
    },
    data() {
        return {
            isPhotoTaken: false,
            isShotPhoto: false,
            isLoading: false,
            link: '#'
        }
    },
    mounted() {
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
        createCameraElement() {
            this.isLoading = true;

            const constraints = (window.constraints = {
                audio: false,
                video: true
            });


            navigator.mediaDevices
                .getUserMedia(constraints)
                .then(stream => {
                    this.isLoading = false;
                    this.$refs.camera.srcObject = stream;
                })
                .catch(error => {
                    this.isLoading = false;
                    alert("May the browser didn't support or there is some errors.");
                });
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
    },
}
</script>

<template>
    <div v-show="isOpen" class="">
        <div v-show="!isLoading" class="relative">
            <video v-show="!isPhotoTaken" ref="camera" class="scale-x-mirror aspect-3/4 object-cover rounded-md"
                   autoplay></video>

            <canvas v-show="isPhotoTaken" class="w-full aspect-3/4" id="photoTaken" ref="canvas"></canvas>

            <div class="absolute w-full top-0 flex flex-row items-center justify-start p-4 gap-4">
                <button type="button" class="btn-icon" @click="close">
                    <XMarkIcon class="h-6 w-6"/>
                </button>
            </div>

            <div class="absolute w-full bottom-0 flex flex-row items-center justify-center p-4 gap-4">
                <button type="button" class="btn-icon" @click="takePhoto">
                    <CameraIcon class="h-6 w-6"/>
                </button>
            </div>
        </div>
    </div>
</template>
