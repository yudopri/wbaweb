<header class="bg-gradient-to-r from-primary to-black text-secondary shadow-lg">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('assets/image/logowba.png') }}" alt="Logo" class="w-12 h-12">
            <div class="text-2xl font-bold">
                <a href="{{ route('home') }}" class="hover:text-black">PT Wira Buana Arum</a>
            </div>
        </div>
        <!-- Navigation Links -->
        <nav class="hidden md:flex space-x-6">
            @foreach(['TENTANG KAMI', 'LAYANAN','ARTICLE', 'PROGRAM KERJA', 'FASILITAS', 'OUR CLIENTS', 'GALLERY', 'KONTAK KAMI'] as $link)
                <a href="{{ route(strtolower(str_replace(' ', '-', $link))) }}" class="hover:text-black">{{ $link }}</a>
            @endforeach
        </nav>
        <button class="md:hidden text-secondary" id="menu-btn"><i class="fas fa-bars"></i></button>
    </div>
    <div class="hidden" id="menu">
        <nav class="flex flex-col space-y-4 py-4 px-6">
            @foreach(['TENTANG KAMI', 'LAYANAN','ARTICLE', 'PROGRAM KERJA', 'FASILITAS', 'OUR CLIENTS', 'GALLERY', 'KONTAK KAMI'] as $link)
                <a href="{{ route(strtolower(str_replace(' ', '-', $link))) }}" class="hover:text-black">{{ $link }}</a>
            @endforeach
        </nav>
    </div>
</header>
