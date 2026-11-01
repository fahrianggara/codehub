<?php

namespace App\Database\Seeds;

use App\Models\ThreadModel;
use CodeIgniter\Database\Seeder;

class ThreadSeeder extends Seeder
{
    public function run()
    {
        $model = new ThreadModel();
        $db = \Config\Database::connect();
        
        $threads = [
            // Thread 1 - PHP question
            [
                'title' => 'Cara Mengoptimalkan Query Database di Laravel',
                'slug' => 'cara-mengoptimalkan-query-database-di-laravel',
                'content' => '<p>Halo semuanya, saya punya masalah dengan aplikasi Laravel yang mulai lambat ketika data di database sudah mencapai ratusan ribu records. Query yang tadinya cepat sekarang bisa sampai 2-3 detik.</p>
<p>Saya sudah coba pakai <code>select()</code> untuk ambil kolom spesifik saja, tapi masih terasa lambat. Ada yang punya tips untuk optimasi query di Laravel?</p>
<p>Beberapa hal yang sudah saya coba:</p>
<ul>
<li>Menggunakan <code>chunk()</code> untuk data besar</li>
<li>Menambahkan index di beberapa kolom</li>
<li>Menggunakan eager loading untuk relasi</li>
</ul>
<p>Tapi masih belum optimal. Mohon sarannya!</p>',
                'status' => 'published',
                'views' => 1247,
                'user_id' => 3, // Ahmad Fauzan
                'created_at' => date('Y-m-d H:i:s', strtotime('-15 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-15 days')),
            ],
            
            // Thread 2 - React tips
            [
                'title' => 'Best Practice untuk State Management di React 2024',
                'slug' => 'best-practice-untuk-state-management-di-react-2024',
                'content' => '<p>Setelah beberapa tahun menggunakan Redux, saya mulai merasa setup-nya terlalu kompleks untuk project skala menengah. Sekarang banyak alternatif seperti Zustand, Jotai, dan Recoil.</p>
<p>Menurut kalian, apa pilihan terbaik untuk state management di React tahun 2024?</p>
<p><strong>Kebutuhan project saya:</strong></p>
<ul>
<li>Medium-sized app dengan 30-40 komponen</li>
<li>Perlu handle async data dari API</li>
<li>Perlu persist beberapa state ke localStorage</li>
<li>TypeScript support</li>
</ul>
<p>Kalau ada yang pernah pakai Zustand, gimana pengalamannya dibanding Redux?</p>',
                'status' => 'published',
                'views' => 892,
                'user_id' => 4, // Dinda Pratiwi
                'created_at' => date('Y-m-d H:i:s', strtotime('-12 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-12 days')),
            ],
            
            // Thread 3 - Bug fixing
            [
                'title' => 'Error CORS saat Hit API dari Frontend ke Backend',
                'slug' => 'error-cors-saat-hit-api-dari-frontend-ke-backend',
                'content' => '<p>Guys, saya stuck dengan error CORS ini sudah 2 hari. Setup saya:</p>
<ul>
<li>Frontend: React di localhost:3000</li>
<li>Backend: Express.js di localhost:5000</li>
</ul>
<p>Error yang muncul:</p>
<pre><code>Access to fetch at \'http://localhost:5000/api/users\' from origin \'http://localhost:3000\' 
has been blocked by CORS policy: No \'Access-Control-Allow-Origin\' header is present</code></pre>
<p>Padahal saya sudah install dan setup <code>cors</code> package di Express:</p>
<pre><code class="language-javascript">const cors = require(\'cors\');
app.use(cors());</code></pre>
<p>Tapi masih tetap error. Ada yang bisa bantu?</p>',
                'status' => 'published',
                'views' => 2156,
                'user_id' => 5, // Rizky Ramadhan
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-9 days')),
            ],
            
            // Thread 4 - Tutorial
            [
                'title' => 'Tutorial Membuat Authentication dengan JWT di CodeIgniter 4',
                'slug' => 'tutorial-membuat-authentication-dengan-jwt-di-codeigniter-4',
                'content' => '<p>Halo teman-teman! Kali ini saya mau share tutorial membuat sistem authentication menggunakan JWT (JSON Web Token) di CodeIgniter 4.</p>
<h3>Kenapa JWT?</h3>
<p>JWT sangat cocok untuk REST API karena stateless dan bisa di-scale dengan mudah.</p>
<h3>Step 1: Install Library</h3>
<pre><code>composer require firebase/php-jwt</code></pre>
<h3>Step 2: Create Helper untuk Generate Token</h3>
<pre><code class="language-php">function generateToken($userId) {
    $key = getenv(\'JWT_SECRET\');
    $payload = [
        \'user_id\' => $userId,
        \'iat\' => time(),
        \'exp\' => time() + (60 * 60 * 24) // 24 hours
    ];
    return JWT::encode($payload, $key, \'HS256\');
}</code></pre>
<h3>Step 3: Validate Token di Filter</h3>
<p>Buat filter baru untuk validasi JWT token di setiap request...</p>
<p><em>(Full tutorial akan saya update di comment section)</em></p>',
                'status' => 'published',
                'views' => 3421,
                'user_id' => 7, // Fajar Hidayat
                'created_at' => date('Y-m-d H:i:s', strtotime('-8 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-8 days')),
            ],
            
            // Thread 5 - Python ML
            [
                'title' => 'Rekomendasi Library Python untuk NLP Bahasa Indonesia',
                'slug' => 'rekomendasi-library-python-untuk-nlp-bahasa-indonesia',
                'content' => '<p>Saya sedang develop aplikasi sentiment analysis untuk teks berbahasa Indonesia. Sudah coba beberapa library seperti:</p>
<ul>
<li><strong>NLTK</strong> - bagus tapi kurang support untuk bahasa Indonesia</li>
<li><strong>Spacy</strong> - model bahasa Indonesia masih limited</li>
<li><strong>Sastrawi</strong> - untuk stemming lumayan</li>
</ul>
<p>Ada yang punya pengalaman dengan NLP bahasa Indonesia? Library apa yang recommended?</p>
<p>Target aplikasi: analisis sentiment review produk dari e-commerce.</p>',
                'status' => 'published',
                'views' => 654,
                'user_id' => 6, // Nabila Putri
                'created_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],
            
            // Thread 6 - Flutter
            [
                'title' => 'Cara Handle Async Operation di Flutter dengan Riverpod',
                'slug' => 'cara-handle-async-operation-di-flutter-dengan-riverpod',
                'content' => '<p>Baru belajar Flutter dan bingung dengan state management. Setelah research, banyak yang recommend Riverpod dibanding Provider.</p>
<p>Saya punya case: fetch data user dari API saat app dibuka, terus display-nya di profile screen.</p>
<p>Dengan Riverpod, apakah lebih simple dibanding Provider? Kalau ada yang udah pakai, bisa share contoh code-nya?</p>
<p>Terutama untuk handle:</p>
<ol>
<li>Loading state</li>
<li>Error handling</li>
<li>Refresh data</li>
</ol>',
                'status' => 'published',
                'views' => 478,
                'user_id' => 8, // Dewi Lestari
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
            
            // Thread 7 - JavaScript
            [
                'title' => 'Perbedaan var, let, dan const di JavaScript - Kapan Pakai Yang Mana?',
                'slug' => 'perbedaan-var-let-dan-const-di-javascript-kapan-pakai-yang-mana',
                'content' => '<p>Sebagai JavaScript developer pemula, saya sering bingung kapan harus pakai <code>var</code>, <code>let</code>, atau <code>const</code>.</p>
<p>Dari yang saya baca:</p>
<ul>
<li><code>var</code> itu old school dan ada masalah hoisting</li>
<li><code>let</code> untuk variable yang nilainya bisa berubah</li>
<li><code>const</code> untuk constant</li>
</ul>
<p>Tapi di real project, best practice-nya gimana ya? Apakah <code>var</code> sudah tidak dipakai lagi sama sekali?</p>
<p>Dan satu lagi, kenapa object yang declared dengan <code>const</code> masih bisa di-mutate?</p>
<pre><code class="language-javascript">const user = { name: \'John\' };
user.name = \'Jane\'; // ini kok bisa ya?</code></pre>',
                'status' => 'published',
                'views' => 1823,
                'user_id' => 9, // Andi Wijaya
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            
            // Thread 8 - UI/UX
            [
                'title' => 'Tools untuk Prototyping UI: Figma vs Adobe XD vs Sketch?',
                'slug' => 'tools-untuk-prototyping-ui-figma-vs-adobe-xd-vs-sketch',
                'content' => '<p>Sebagai UI/UX designer yang baru mulai freelance, saya masih pakai Adobe XD. Tapi sekarang banyak client yang request design file dalam format Figma.</p>
<p>Worth it gak ya untuk switch ke Figma? Atau tetap bertahan di Adobe XD?</p>
<p><strong>Yang saya pertimbangkan:</strong></p>
<ul>
<li>Collaboration feature (penting karena sering kollab dengan developer)</li>
<li>Plugin ecosystem</li>
<li>Performance dengan file besar</li>
<li>Pricing (free tier cukup gak untuk freelancer?)</li>
</ul>
<p>Buat yang udah pernah pakai keduanya, share pengalaman dong!</p>',
                'status' => 'published',
                'views' => 721,
                'user_id' => 10, // Maya Safitri
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            
            // Thread 9 - Database
            [
                'title' => 'MySQL vs PostgreSQL untuk Web App - Mana yang Lebih Baik?',
                'slug' => 'mysql-vs-postgresql-untuk-web-app-mana-yang-lebih-baik',
                'content' => '<p>Saya lagi planning architecture untuk web app baru (e-learning platform). Bingung pilih database: MySQL atau PostgreSQL?</p>
<p><strong>Requirements:</strong></p>
<ul>
<li>User management (±50k users)</li>
<li>Course content (video metadata, quiz, assignments)</li>
<li>Progress tracking per user</li>
<li>Analytics & reporting</li>
</ul>
<p>Selama ini saya lebih familiar dengan MySQL (pakai di Laravel). Tapi katanya PostgreSQL lebih powerful untuk complex query dan JSON data.</p>
<p>Yang punya pengalaman dengan both, tolong kasih insight dong. Apakah PostgreSQL worth the learning curve?</p>',
                'status' => 'published',
                'views' => 1456,
                'user_id' => 11, // Rudi Hermawan
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            
            // Thread 10 - Git
            [
                'title' => 'Cara Mengatasi Merge Conflict di Git - Tips untuk Pemula',
                'slug' => 'cara-mengatasi-merge-conflict-di-git-tips-untuk-pemula',
                'content' => '<p>Sebagai developer junior, merge conflict di Git itu momok banget buat saya 😅</p>
<p>Kemarin saya kena conflict waktu merge branch feature ke main. Akhirnya malah corrupt code-nya dan harus rollback.</p>
<p><strong>Yang saya bingung:</strong></p>
<ol>
<li>Gimana cara baca conflict marker <code>&lt;&lt;&lt;&lt;&lt;&lt;&lt;</code>, <code>=======</code>, <code>&gt;&gt;&gt;&gt;&gt;&gt;&gt;</code>?</li>
<li>Kapan harus pilih "Accept Current" vs "Accept Incoming"?</li>
<li>Kalau conflict-nya banyak (50+ files), apakah ada cara yang lebih efisien?</li>
</ol>
<p>Tools yang biasa kalian pakai untuk resolve conflict apa ya? VSCode built-in aja cukup atau perlu install extension tertentu?</p>',
                'status' => 'published',
                'views' => 2341,
                'user_id' => 12, // Intan Permata
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            
            // Thread 11 - Security
            [
                'title' => 'Implementasi Rate Limiting untuk Prevent Brute Force Attack',
                'slug' => 'implementasi-rate-limiting-untuk-prevent-brute-force-attack',
                'content' => '<p>Kemarin web app saya kena brute force attack di endpoint login. Untung cepat ketahuan dari monitoring.</p>
<p>Sekarang saya mau implement rate limiting. Stack yang saya pakai:</p>
<ul>
<li>Backend: Express.js</li>
<li>Database: MongoDB</li>
<li>Deployment: DigitalOcean</li>
</ul>
<p>Saya udah research ada beberapa package:</p>
<ul>
<li><code>express-rate-limit</code></li>
<li><code>rate-limiter-flexible</code></li>
<li>Atau pakai Redis?</li>
</ul>
<p>Yang paling recommended apa ya? Dan berapa batas yang reasonable untuk login endpoint (berapa request per menit)?</p>',
                'status' => 'published',
                'views' => 876,
                'user_id' => 13, // Hendra Setiawan
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            
            // Thread 12 - Mobile dev
            [
                'title' => 'Flutter vs React Native 2024: Pilih Mana untuk Startup Project?',
                'slug' => 'flutter-vs-react-native-2024-pilih-mana-untuk-startup-project',
                'content' => '<p>Startup saya mau develop mobile app (iOS & Android) dan team lagi diskusi mau pakai Flutter atau React Native.</p>
<p><strong>Context:</strong></p>
<ul>
<li>Team developer: 3 orang (background JavaScript)</li>
<li>Timeline: 3 bulan MVP</li>
<li>Budget: limited (gak bisa hire specialized Flutter dev)</li>
</ul>
<p>Pertimbangan saya:</p>
<p><strong>Flutter:</strong></p>
<ul>
<li>✅ Performance katanya lebih baik</li>
<li>✅ UI consistency across platform</li>
<li>❌ Team harus belajar Dart dari 0</li>
</ul>
<p><strong>React Native:</strong></p>
<ul>
<li>✅ Team sudah familiar dengan JS/React</li>
<li>✅ Banyak library available</li>
<li>❌ Bridge to native performance concern?</li>
</ul>
<p>Yang punya experience dengan both, please share! Mana yang lebih realistic untuk 3-month timeline?</p>',
                'status' => 'published',
                'views' => 1654,
                'user_id' => 14, // Rina Anggraini
                'created_at' => date('Y-m-d H:i:s', strtotime('-12 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-12 hours')),
            ],
            
            // Thread 13 - DevOps
            [
                'title' => 'Setup CI/CD Pipeline dengan GitHub Actions - Worth It atau Ribet?',
                'slug' => 'setup-ci-cd-pipeline-dengan-github-actions-worth-it-atau-ribet',
                'content' => '<p>Selama ini deployment app saya masih manual: pull dari Git terus restart service di server.</p>
<p>Tapi sekarang teamnya udah bertambah dan sering ada conflict karena deployment manual. Makanya mau coba setup CI/CD.</p>
<p>GitHub Actions itu se-complicated apa ya untuk pemula? Atau better pakai Heroku yang auto-deploy aja?</p>
<p><strong>Yang mau saya automate:</strong></p>
<ol>
<li>Run test suite</li>
<li>Build production assets</li>
<li>Deploy ke VPS (bukan cloud platform)</li>
<li>Notify ke Slack kalau success/failed</li>
</ol>
<p>Ada yang punya example workflow file yang simple? Atau tutorial yang recommended?</p>',
                'status' => 'published',
                'views' => 567,
                'user_id' => 15, // Arif Rahman
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-6 hours')),
            ],
            
            // Thread 14 - Draft example
            [
                'title' => 'Optimasi Performa Web dengan Lazy Loading Images',
                'slug' => 'optimasi-performa-web-dengan-lazy-loading-images',
                'content' => '<p>Artikel ini masih dalam proses penulisan. Akan membahas tentang implementasi lazy loading untuk optimasi performance web application.</p>
<p><em>Coming soon...</em></p>',
                'status' => 'draft',
                'views' => 0,
                'user_id' => 7, // Fajar Hidayat
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
            ],
        ];

        foreach ($threads as $thread) {
            $model->insert($thread);
        }
    }
}
