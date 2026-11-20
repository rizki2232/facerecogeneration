<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="final.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-50 transition-all duration-300" x-data="{ sidebarOpen: false }">
    <div class="relative">
        <!-- Main Content -->
        <div class="flex-1 transition-all duration-300">
            <!-- Main Content Area -->
            <main class="pt-12 flex-1">
                <div class="py-4 h-full">
                    <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
                        <div class="bg-white shadow-sm sm:rounded-lg h-full p-7">
                            <div class="mb-8">
                                <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                                    Profile
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Manage your name, password and account settings.
                                </p>
                            </div>

                            

                            <label >Age:</label>
                            <input type="number" name="age" required><br><br>

                            <label for="address">Address:</label>
                            <input type="text" name="address" required><br><br>

                            <label for="class">Class:</label>
                            <input type="text" name="class" required><br><br>

                            <button type="submit">Register</button>
                        </form>

                        <form method="POST" action="http://localhost:5000/register">
                                <!-- Grid -->
                                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">

                                    <div class="sm:col-span-3">
                                        <label for="af-account-full-name" for="name"
                                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200" type="text" name="name" required>
                                            Nama lengkap
                                        </label>
                                    </div>
                                    <!-- End Col -->

                                    <div class="sm:col-span-9">
                                        <div class="sm:flex">
                                            <input id="af-account-full-name" type="text"
                                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                placeholder="Maria">
                                        </div>
                                    </div>
                                    <!-- End Col -->

                                    
                                    <!-- End Col -->

                                    <div class="sm:col-span-9">
                                        <div class="sm:flex">
                                            <label for="af-account-gender-checkbox"
                                                class="flex py-2 px-3 w-full border border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                <input type="radio" name="af-account-gender-checkbox"
                                                    class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                    id="af-account-gender-checkbox" checked>
                                                <span
                                                    class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Laki-laki</span>
                                            </label>

                                            <label for="af-account-gender-checkbox-femal"
                                                class="flex py-2 px-3 w-full border border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                <input type="radio" name="af-account-gender-checkbox"
                                                    class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                    id="af-account-gender-checkbox-femal">
                                                <span
                                                    class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Perempuan</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End Col -->

                                    <div class="sm:col-span-3">
                                        <label for="af-account-email"
                                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                            Kelas
                                        </label>
                                    </div>
                                    <!-- End Col -->

                                    <div class="sm:col-span-9">
                                        <select name="classroom" id="classroom" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected="">Pilih kelas</option>
                                            <option value="">X-MIPA 1</option>
                                            <option value="">X-MIPA 1</option>
                                            <option value="">X-MIPA 1</option>
                                        </select>
                                        <!-- <input id="af-account-email" type="email"
                                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="maria@site.com"> -->
                                    </div>
                                    <!-- End Col -->

                                    <div class="sm:col-span-3">
                                        <label for="af-account-bio"
                                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                            Alamat
                                        </label>
                                    </div>
                                    <!-- End Col -->

                                    <div class="sm:col-span-9">
                                        <textarea id="af-account-bio"
                                            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            rows="6" placeholder="Ketikkan alamat anda..."></textarea>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Grid -->

                                <div class="mt-5 flex justify-end gap-x-2">
                                    <button type="button"
                                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                        Cancel
                                    </button>
                                    <button type="button"
                                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                        Save changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>