<x-app-layout>

<div class="max-w-xl mx-auto py-16 px-6">

    <div class="bg-white rounded-3xl shadow-lg p-10 border border-[#eadfce] text-center">

        <div class="text-6xl mb-5">
            📱
        </div>

        <h1 class="text-3xl font-bold text-[#2e1a0e] mb-3">
            GCash Payment
        </h1>

        <p class="text-[#9d7d6a] mb-8">
            Scan the QR code or send payment to:
        </p>

        <div class="bg-[#faf6f1] rounded-2xl p-6 mb-6">

            <img src="{{ asset('img/QR.jpg') }}"
                 class="w-64 mx-auto rounded-2xl">

        </div>

        <div class="space-y-2 mb-8">

            <p class="text-lg font-semibold text-[#2e1a0e]">
                09928040273
            </p>

            <p class="text-[#9d7d6a]">
                CrochetCraft Official
            </p>

        </div>

        <form action="{{ route('checkout.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <input type="hidden"
           name="payment_method"
           value="gcash">

    {{-- Upload Proof --}}
    <div class="mb-6 text-left">

        <label class="block text-sm font-medium text-[#7d6b60] mb-3">
            Upload Proof of Payment
        </label>

        <label for="proof"
               class="border-2 border-dashed border-[#d9c8b5] rounded-2xl p-6 flex flex-col items-center justify-center cursor-pointer bg-[#faf6f1] hover:bg-[#f5eee7] transition">

            <div class="text-4xl mb-3">
                🖼️
            </div>

            <p class="text-sm text-[#7d6b60]">
                Click to upload screenshot / receipt
            </p>

            <p class="text-xs text-[#b09a87] mt-1">
                JPG, PNG only
            </p>

            <input type="file"
                   id="proof"
                   name="proof"
                   accept="image/*"
                   class="hidden"
                   required>

        </label>

        {{-- Preview --}}
        <div id="previewContainer"
             class="hidden mt-5">

            <img id="previewImage"
                 class="w-full rounded-2xl border border-[#eadfce]">
        </div>

        @error('proof')
            <p class="text-red-500 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

    </div>

    <button type="submit"
            id="submitBtn"
            disabled
            class="w-full bg-gray-400 cursor-not-allowed text-white py-4 rounded-2xl font-medium transition">

        Upload Proof First

    </button>

</form>



    </div>

</div>
<script>
    const proofInput = document.getElementById('proof');
    const submitBtn = document.getElementById('submitBtn');
    const previewImage = document.getElementById('previewImage');
    const previewContainer = document.getElementById('previewContainer');

    proofInput.addEventListener('change', function () {

        const file = this.files[0];

        if (file) {

            // Enable button
            submitBtn.disabled = false;

            submitBtn.classList.remove(
                'bg-gray-400',
                'cursor-not-allowed'
            );

            submitBtn.classList.add(
                'bg-[#c4693f]',
                'hover:bg-[#9e4a28]'
            );

            submitBtn.innerText = 'I Already Paid';

            // Preview image
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        }
    });
</script>
</x-app-layout>