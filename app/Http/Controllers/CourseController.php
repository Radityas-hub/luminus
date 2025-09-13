<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
	public function show($id)
	{
		// Untuk sementara gunakan data statis
		$courses = [
			[
				'id' => 1,
				'thumbnail' => 'https://www.youtube.com/embed/ioCSv08RdhU?si=mpX01lCtijzRODEv',
				'category' => 'LMS Website',
				'subCategory' => 'With JavaScript',
				'title' => 'Full-Stack JavaScript : Website LMS',
				'duration' => '12 jam',
				'modules' => '6 modul',
				'originalPrice' => '550000',
				'discountPrice' => '299000',
				'popularity' => 100,
				'description' => 'Kursus ini dirancang untuk membantu Anda memahami dan menguasai pembuatan Website Learning Management System (LMS) menggunakan JavaScript. Anda akan belajar cara membangun sistem pembelajaran online yang modern, responsif, dan kaya fitur, mulai dari dasar hingga implementasi fitur-fitur canggih.',
				'materi' => [
					[
						'title' => 'Materi 0 : Pengenalan JavaScript dan React',
						'description' => 'Materi ini mencakup dasar-dasar JavaScript modern, termasuk sintaks ES6+ seperti let, const, arrow functions, dan spread operator. Selain itu, peserta akan diperkenalkan pada React sebagai library frontend untuk membangun antarmuka pengguna yang dinamis dan responsif.'
					],
					[
						'title' => 'Materi 1 : Struktur dan Alur Aplikasi LMS',
						'description' => 'Peserta akan mempelajari arsitektur dasar aplikasi LMS, termasuk cara memisahkan tugas antara frontend dan backend. Materi ini juga menjelaskan bagaimana data dikelola dan dialirkan di dalam sistem untuk mendukung fitur seperti pendaftaran pengguna dan pelacakan kemajuan.'
					],
					[
						'title' => 'Materi 2 : Penggunaan Array dalam Pengelolaan Data',
						'description' => 'Di bagian ini, peserta akan mempelajari bagaimana array digunakan untuk menyimpan dan mengelola data seperti daftar kursus, pengguna, dan materi pembelajaran. Fokus akan diberikan pada metode array bawaan seperti map(), filter(), reduce(), dan sort() untuk memproses data secara efisien.'
					],
					[
						'title' => 'Materi 3 : Membuat Komponen React untuk LMS',
						'description' => 'Peserta akan belajar cara membangun komponen React yang modular dan dapat digunakan kembali. Contohnya meliputi komponen daftar kursus, halaman profil pengguna, serta sistem pelacakan progres belajar. Pendekatan berbasis komponen ini memastikan aplikasi mudah diperluas dan dipelihara.'
					],
					[
						'title' => 'Materi 4 : State Management dengan React',
						'description' => 'Bagian ini akan membahas cara mengelola state aplikasi menggunakan React State dan Context API. Peserta akan memahami bagaimana state memengaruhi antarmuka pengguna dan bagaimana cara mengelola data kompleks di aplikasi LMS, seperti data pengguna yang terhubung antar komponen.'
					],
					[
						'title' => 'Materi 5 : Integrasi JavaScript dengan Backend',
						'description' => 'Materi ini membahas bagaimana frontend berkomunikasi dengan backend menggunakan JavaScript. Peserta akan mempelajari cara mengirim dan menerima data menggunakan fetch atau axios untuk membuat aplikasi LMS yang dapat menyimpan dan mengambil data dari server secara real-time.'
					],
					[
						'title' => 'Materi 6 : Membangun Fitur Interaktif pada LMS',
						'description' => 'Peserta akan belajar membangun fitur interaktif seperti pencarian kursus, filter berdasarkan kategori, dan fitur penyimpanan kemajuan belajar. Array akan digunakan untuk memproses dan menampilkan data secara dinamis dalam antarmuka aplikasi LMS.'
					],
					[
						'title' => 'Materi 7 : Mengoptimalkan Aplikasi LMS',
						'description' => 'Bagian ini fokus pada peningkatan performa aplikasi LMS. Peserta akan mempelajari teknik-teknik seperti lazy loading, memoization, dan penggunaan React.memo untuk mengurangi rendering yang tidak perlu dan meningkatkan pengalaman pengguna.'
					],
					[
						'title' => 'Materi 8 : Pengenalan Deployment Aplikasi',
						'description' => 'Pada tahap akhir, peserta akan diperkenalkan pada langkah-langkah untuk mempublikasikan aplikasi LMS ke internet. Materi ini mencakup pengaturan hosting pada platform seperti Vercel atau Netlify, serta pengelolaan domain untuk menjangkau pengguna secara global.'
					]
				],

				'learning_outcomes' => [
					[
						'title' => 'Memahami Konsep Full-Stack Development',
						'description' => 'Mampu menjelaskan dan mengaplikasikan peran frontend dan backend dalam pengembangan aplikasi LMS'
					],
					[
						'title' => 'Menguasai Dasar-Dasar Pengelolaan Data dengan Array',
						'description' => 'Memahami cara kerja array serta menggunakan metode bawaan JavaScript untuk pengelolaan data'
					],
					[
						'title' => 'Mengimplementasikan Logika LMS dengan JavaScript',
						'description' => 'Membangun fitur utama LMS seperti pendaftaran pengguna, penyimpanan data kursus, dan pelacakan kemajuan'
					],
					[
						'title' => 'Mengembangkan Website LMS yang Interaktif dan Responsif',
						'description' => 'Mampu membuat antarmuka pengguna yang dinamis dengan memanfaatkan HTML, CSS, dan JavaScript modern'
					],
					[
						'title' => 'Menguasai JavaScript Modern',
						'description' => 'Menggunakan fitur ES6+ seperti arrow functions, destructuring, dan spread operator dalam pengembangan aplikasi'
					],
					[
						'title' => 'Mengintegrasikan Array ke dalam Pengolahan Data LMS',
						'description' => 'Menggunakan array untuk mengelola data seperti daftar pengguna, kursus, dan materi pembelajaran secara efisien'
					],
					[
						'title' => 'Membuat Fitur Pencarian dan Filter pada LMS',
						'description' => 'Menerapkan metode array seperti filter(), map(), dan reduce() untuk pengelolaan data secara dinamis'
					]
				]

			]
			// Tambahkan data kursus lainnya
		];

		$course = collect($courses)->firstWhere('id', (int) $id);

		if (!$course) {
			abort(404);
		}

		return view('coursesPage.detail', compact('course'));
	}
}
