<div class="z-50 fixed top-0 left-0 right-0 flex flex-col gap-2 pt-4 px-3">
    @if (session('status'))
        <x-alert-status type="success">
            {{ session('status')  }}
        </x-alert-status>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $key=>$error)
            <x-alert-status type="error" :during="$key+2">
                {{ $error  }}
            </x-alert-status>
        @endforeach
    @endif
</div>

