<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-gray-50 transition-all duration-300" x-data="{ sidebarOpen: false }">
    <div class="relative">
        <!-- Main Content -->
        <div class="flex-1 transition-all duration-300">
            <?php include 'sidebar.php'; ?>
            <!-- Main Content Area -->
            <main class="pt-12 flex-1">
                <div class="py-4 h-full">
                    <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
                        <div class="bg-white shadow-sm sm:rounded-lg h-full p-7">
                            <div class="mb-8">
                                <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                                    Tambah siswa
                                </h2>
                            </div>

                            <form method="POST" action="http://localhost:5000/register">
                                <!-- Grid -->
                                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                                    <!-- Name Field -->
                                    <div class="sm:col-span-3">
                                        <label for="name" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                            Nama Lengkap
                                        </label>
                                    </div>
                                    <div class="sm:col-span-9">
                                        <input type="text" id="name" name="name"
                                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Masukkan nama lengkap Anda" required>
                                    </div>
                                    <!-- End Name Field -->

                                    <!-- NISN Field -->
                                    <div class="sm:col-span-3">
                                        <label for="NISN" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                            NISN
                                        </label>
                                    </div>
                                    <div class="sm:col-span-9">
                                        <input type="number" id="NISN" name="NISN"
                                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Masukkan NISN Anda" required>
                                    </div>
                                    <!-- End NISN Field -->

                                    <!-- Class Field -->
                                    <div class="sm:col-span-3">
                                        <label for="class" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                            Kelas
                                        </label>
                                    </div>
                                    <div class="sm:col-span-9">
                                        <input type="text" id="class" name="class"
                                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Masukkan kelas Anda, contoh: MIPA 1" required>
                                    </div>
                                    <!-- End Class Field -->
                                </div>
                                <!-- End Grid -->

                                <!-- Submit and Cancel Buttons -->
                                <div class="mt-5 flex justify-end gap-x-2">
                                    <a href="/facerecogeneration_benar/revisi/student.php"
                                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                        Save Changes
                                    </button>
                                </div>
                                <!-- End Buttons -->
                            </form>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>