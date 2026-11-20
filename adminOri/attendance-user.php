<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- <link rel="stylesheet" href="final.css" /> -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-gray-50 transition-all duration-300">
    <div class="relative">
        <!-- Main Content -->
        <div class="flex-1 transition-all duration-300">
            <!-- Main Content Area -->
            <main class="pt-12 flex-1">
                <div class="py-4 h-full">
                    <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
                        <div class="bg-white shadow-sm sm:rounded-lg h-full">
                            <div class="h-full border-r flex flex-col">
                                <div class="p-4 pb-2">
                                    <p class="text-muted-foreground">Terbaru</p>
                                    <input type="text" name="search" id="search"
                                        class="w-full mt-2 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" />
                                </div>
                                <div class="flex-grow p-4 overflow-y-auto">
                                    <div class="flex flex-col gap-y-2 max-h-[calc(100vh-240px)]">
                                        <!-- Daftar nama -->
                                        <div x-data="{ open: false }"
                                            class="rounded-lg border p-3 text-left text-sm transition-all hover:bg-gray-100">
                                            <div @click="open = true" class="flex w-full justify-between gap-1">
                                                <div class="flex flex-col space-y-1">
                                                    <div class="font-semibold">Reza Andyah Wijaya</div>
                                                    <div class="text-xs">XII-MIPA 7</div>
                                                </div>
                                                <div class="flex flex-col space-y-1">
                                                    <div class="text-xs text-right">07:00 WIB</div>
                                                    <div
                                                        class="ml-auto inline-flex items-center rounded-md bg-red-500 text-white px-2.5 py-0.5 text-xs font-semibold shadow">
                                                        Terlambat
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Popup dialog overlay and content -->
                                            <div x-show="open" x-transition:enter
                                                class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50"
                                                @click.outside="open = false" style="display: none">
                                                <div @click.outside="open = false"
                                                    class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
                                                    <!-- Close button -->
                                                    <button @click="open = false"
                                                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>

                                                    <!-- Dialog content -->
                                                    <div class="mb-4">
                                                        <h2 class="text-xl font-semibold text-gray-800">
                                                            Reza Andyah Wijaya
                                                        </h2>
                                                        <p class="text-sm text-gray-600">18995 | XII-MIPA 7</p>
                                                    </div>

                                                    <h5 class="text-gray-600 mb-2">Detail Kehadiran</h5>
                                                    <div class="grid grid-cols-5 gap-2 mb-8">
                                                        <p class="text-black">Tanggal</p>
                                                        <p class="col-span-4 text-black">: 25/11/2024</p>
                                                        <p class="text-black">Pukul</p>
                                                        <p class="col-span-4 text-black">
                                                            : 07:00 WIB
                                                        </p>
                                                        <p class="text-black">Keterangan</p>
                                                        <p class="col-span-4 text-black">
                                                            : Terlambat (5 mnt)
                                                        </p>
                                                    </div>

                                                    <!-- Close dialog button -->
                                                    <button @click="open = false"
                                                        class="w-full bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                                                        Tutup
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div x-data="{ open: false }"
                                            class="rounded-lg border p-3 text-left text-sm transition-all hover:bg-gray-100">
                                            <div @click="open = true" class="flex w-full justify-between gap-1">
                                                <div class="flex flex-col space-y-1">
                                                    <div class="font-semibold">Reza Andyah Wijaya</div>
                                                    <div class="text-xs">XII-MIPA 9</div>
                                                </div>
                                                <div class="flex flex-col space-y-1">
                                                    <div class="text-xs text-right">06:30 WIB</div>
                                                    <div
                                                        class="ml-auto inline-flex items-center rounded-md bg-green-400 text-white px-2.5 py-0.5 text-xs font-semibold shadow">
                                                        Tepat Waktu
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Popup dialog overlay and content -->
                                            <div x-show="open" x-transition:enter
                                                class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50"
                                                @click.outside="open = false" style="display: none">
                                                <div @click.outside="open = false"
                                                    class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
                                                    <!-- Close button -->
                                                    <button @click="open = false"
                                                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>

                                                    <!-- Dialog content -->
                                                    <div class="mb-4">
                                                        <h2 class="text-xl font-semibold text-gray-800">
                                                            Reza Andyah Wijaya
                                                        </h2>
                                                        <p class="text-sm text-gray-600">18995 | XII-MIPA 7</p>
                                                    </div>

                                                    <h5 class="text-gray-600 mb-2">Detail Kehadiran</h5>
                                                    <div class="grid grid-cols-5 gap-2 mb-8">
                                                        <p class="text-black">Tanggal</p>
                                                        <p class="col-span-4 text-black">: 25/11/2024</p>
                                                        <p class="text-black">Pukul</p>
                                                        <p class="col-span-4 text-black">
                                                            : 06:30 WIB
                                                        </p>
                                                        <p class="text-black">Keterangan</p>
                                                        <p class="col-span-4 text-black">
                                                            : Tepat Waktu
                                                        </p>
                                                    </div>

                                                    <!-- Close dialog button -->
                                                    <button @click="open = false"
                                                        class="w-full bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                                                        Tutup
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tambahkan item absensi lainnya di sini -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>