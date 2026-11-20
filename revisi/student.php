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
            <!-- Main Content Area -->
            <main class="pt-12 flex-1">
            <?php include 'sidebar.php'; ?>
                <div class="py-4 h-full">
                    <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
                        <div class="bg-white shadow-sm sm:rounded-lg h-full">
                            <!-- Header -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                        Siswa
                                    </h2>
                                    <!-- <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        Add users, edit and more.
                                    </p> -->
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <!-- <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                            href="#">
                                            View all
                                        </a> -->

                                        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                            href="/facerecogeneration_benar/revisi/student-form.php">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14" />
                                                <path d="M12 5v14" />
                                            </svg>
                                            Tambah siswa
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                no
                                            </span>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap min-w-64">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                Nisn
                                            </span>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                nama
                                            </span>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                kelas
                                            </span>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-end"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                <?php
                                    require_once("koneksi.php");

                                    $query = "SELECT * FROM siswa ";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0) {
                                        $index = 1;
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                    
                                        <tr>
                                            <td class="size-px whitespace-nowrap px-6 py-3">
                                                <span class="text-sm text-gray-800 dark:text-neutral-200"><?php echo $index; ?></span>
                                            </td>
                                            <td class="size-px whitespace-nowrap px-6 py-3">
                                                <span
                                                    class="font-semibold text-sm text-gray-800 dark:text-white"><?php echo $row["NISN"]; ?></span>
                                            </td>
                                            <td class="size-px whitespace-nowrap px-6 py-3">
                                                <span class="text-sm text-gray-800 dark:text-white"><?php echo $row["name"]; ?></span>
                                            </td>
                                            <td class="size-px whitespace-nowrap px-6 py-3">
                                                <span class="text-sm text-gray-800 dark:text-white"><?php echo $row["class"]; ?></span>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-1.5">
                                                    <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500"
                                                        href="student-edit.php?id=<?php echo $row['id']; ?>">
                                                        Edit
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            $index++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>Tidak ada data yang ditemukan</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>