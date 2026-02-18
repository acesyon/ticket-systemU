<x-layouts>
    {{-- Title Prop: Setting layout.blade.php $title to Recipe Book --}}
    <x-slot:title>
        Recipe Book
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <div class="bg--base-100 shadow mt-8 rounded-xl">
            <div class="p-8 text-center">
                <!-- WELCOME CARD -->
                <div class="space-y-5">
                    <div class="space-y-3">
                        <h1 class="text-3xl font-bold">Welcome! 👋</h1>
                        <p class="text-based-content/60">
                            Create something new. Save the recipe before you forget.
                        </p>
                    </div>
                    <div class="pt-2">
                        <a href="/recipe-new"
                           class="inline-block px-5 py-2 border-2 border-[#917160] text-[#917160] font-semibold hover:bg-[#917160] hover:text-white rounded transition">
                            Create New
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts>
