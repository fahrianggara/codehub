<?php

namespace App\Database\Seeds;

use App\Models\ReplyModel;
use CodeIgniter\Database\Seeder;

class ReplySeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        $replies = [
            // Replies for Thread 1 (Laravel optimization)
            [
                'content' => '<p>Coba pakai <code>lazy()</code> untuk iterate data besar. Ini lebih memory efficient dibanding <code>chunk()</code>:</p>
<pre><code class="language-php">User::query()->lazy()->each(function ($user) {
    // process user
});</code></pre>
<p>Dan jangan lupa <strong>always use index</strong> di kolom yang sering di-query!</p>',
                'approved' => 1,
                'thread_id' => 1,
                'user_id' => 7, // Fajar Hidayat
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 days 8 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-14 days 8 hours')),
            ],
            [
                'content' => '<p>Thanks! Saya coba dulu pakai lazy(). BTW kalau untuk optimize join query gimana ya?</p>',
                'approved' => 1,
                'thread_id' => 1,
                'user_id' => 3, // Ahmad Fauzan (thread author)
                'child_id' => 1,
                'parent_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 days 4 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-14 days 4 hours')),
            ],
            [
                'content' => '<p>Untuk join, pastikan kolom foreign key sudah ada index. Dan kalau bisa avoid SELECT * - pilih kolom yang benar-benar diperlukan aja.</p>',
                'approved' => 1,
                'thread_id' => 1,
                'user_id' => 11, // Rudi Hermawan
                'child_id' => 2,
                'parent_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 days 2 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-14 days 2 hours')),
            ],
            [
                'content' => '<p>Jangan lupa monitor query pakai Laravel Telescope atau Debugbar. Kadang bottleneck-nya bukan di query tapi di N+1 problem.</p>',
                'approved' => 1,
                'thread_id' => 1,
                'user_id' => 13, // Hendra Setiawan
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-13 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-13 days')),
            ],
            
            // Replies for Thread 2 (React state management)
            [
                'content' => '<p>Saya pakai Zustand untuk project skala menengah dan sangat satisfied! Setup-nya super simple:</p>
<pre><code class="language-javascript">import create from \'zustand\';

const useStore = create((set) => ({
    user: null,
    setUser: (user) => set({ user })
}));</code></pre>
<p>No boilerplate seperti Redux. Dan support DevTools juga!</p>',
                'approved' => 1,
                'thread_id' => 2,
                'user_id' => 9, // Andi Wijaya
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-11 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-11 days')),
            ],
            [
                'content' => '<p>+1 untuk Zustand. Untuk async data fetch, saya combine dengan React Query. Perfect combo!</p>',
                'approved' => 1,
                'thread_id' => 2,
                'user_id' => 15, // Arif Rahman
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-11 days 6 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-11 days 6 hours')),
            ],
            [
                'content' => '<p>Kalau project-nya TypeScript, Zustand + React Query memang best combo. TypeScript support-nya excellent.</p>',
                'approved' => 1,
                'thread_id' => 2,
                'user_id' => 7, // Fajar Hidayat
                'child_id' => 6,
                'parent_id' => 6,
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
            
            // Replies for Thread 3 (CORS error) - This one gets solved
            [
                'content' => '<p>Coba tambahkan credentials di setup CORS:</p>
<pre><code class="language-javascript">app.use(cors({
    origin: \'http://localhost:3000\',
    credentials: true
}));</code></pre>
<p>Dan di frontend, tambahkan credentials di fetch:</p>
<pre><code class="language-javascript">fetch(url, {
    credentials: \'include\'
});</code></pre>',
                'approved' => 1,
                'thread_id' => 3,
                'user_id' => 13, // Hendra Setiawan
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days 18 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-10 days 18 hours')),
            ],
            [
                'content' => '<p>SOLVED! Ternyata masalahnya di order middleware. CORS harus diload sebelum middleware lain.</p>
<pre><code class="language-javascript">const app = express();

// CORS harus paling atas!
app.use(cors({
    origin: \'http://localhost:3000\'
}));

// baru middleware lain
app.use(express.json());
// ...</code></pre>
<p>Thanks all!</p>',
                'approved' => 1,
                'thread_id' => 3,
                'user_id' => 5, // Rizky Ramadhan (thread author)
                'child_id' => 8,
                'parent_id' => 8,
                'created_at' => date('Y-m-d H:i:s', strtotime('-9 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-9 days')),
            ],
            [
                'content' => '<p>Good to hear it\'s solved! Untuk production jangan lupa ganti <code>origin: \'*\'</code> dengan domain specific ya 👍</p>',
                'approved' => 1,
                'thread_id' => 3,
                'user_id' => 13, // Hendra Setiawan
                'child_id' => 9,
                'parent_id' => 8,
                'created_at' => date('Y-m-d H:i:s', strtotime('-9 days 2 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-9 days 2 hours')),
            ],
            
            // Replies for Thread 4 (JWT Tutorial)
            [
                'content' => '<p>Bagus tutorialnya! Saya tambahkan untuk Step 3:</p>
<pre><code class="language-php">class JWTFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = getenv(\'JWT_SECRET\');
        $header = $request->getHeader(\'Authorization\');
        $token = null;
        
        if (!empty($header)) {
            $token = explode(\' \', $header)[1] ?? null;
        }
        
        if ($token) {
            try {
                $decoded = JWT::decode($token, $key, [\'HS256\']);
                $request->userId = $decoded->user_id;
            } catch (\\Exception $e) {
                return Services::response()
                    ->setJSON([\'error\' => \'Invalid token\'])
                    ->setStatusCode(401);
            }
        }
    }
}</code></pre>',
                'approved' => 1,
                'thread_id' => 4,
                'user_id' => 3, // Ahmad Fauzan
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],
            [
                'content' => '<p>Thanks for sharing! Satu pertanyaan: untuk refresh token gimana implementasinya?</p>',
                'approved' => 1,
                'thread_id' => 4,
                'user_id' => 12, // Intan Permata
                'child_id' => 11,
                'parent_id' => 11,
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
            
            // Replies for Thread 5 (NLP Bahasa Indonesia)
            [
                'content' => '<p>Untuk NLP Bahasa Indonesia, saya recommend:</p>
<ul>
<li><strong>IndoNLP</strong> - specifically designed untuk Bahasa Indonesia</li>
<li><strong>Sastrawi</strong> - untuk stemming memang yang terbaik</li>
<li><strong>Indonesian NLP</strong> toolkit by Kata.ai</li>
</ul>
<p>Kalau mau yang powerful, coba pretrained model dari HuggingFace yang udah di-train dengan dataset Bahasa Indonesia.</p>',
                'approved' => 1,
                'thread_id' => 5,
                'user_id' => 11, // Rudi Hermawan
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
            [
                'content' => '<p>Saya pernah pakai IndoBERT untuk sentiment analysis. Akurasinya cukup tinggi (85%+) untuk dataset review Indonesia.</p>
<p>Link: <a href="#">https://huggingface.co/indobenchmark/indobert-base-p1</a></p>',
                'approved' => 1,
                'thread_id' => 5,
                'user_id' => 7, // Fajar Hidayat
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            
            // Replies for Thread 7 (var, let, const)
            [
                'content' => '<p>Simple rule of thumb:</p>
<ul>
<li><strong>Jangan pakai <code>var</code> lagi</strong> - deprecated best practice</li>
<li>Default pakai <code>const</code></li>
<li>Kalau variable-nya perlu di-reassign, baru pakai <code>let</code></li>
</ul>
<p>Untuk pertanyaan object mutation:</p>
<pre><code class="language-javascript">const user = { name: \'John\' };

// Ini BISA karena yang const itu reference-nya
user.name = \'Jane\'; // ✅

// Ini TIDAK BISA karena reassign reference
user = { name: \'Jane\' }; // ❌ Error</code></pre>
<p>Kalau mau object benar-benar immutable, pakai <code>Object.freeze()</code>.</p>',
                'approved' => 1,
                'thread_id' => 7,
                'user_id' => 15, // Arif Rahman
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'content' => '<p>Perfect explanation! Jadi <code>const</code> itu protect reference-nya, bukan value-nya. TIL 🙏</p>',
                'approved' => 1,
                'thread_id' => 7,
                'user_id' => 9, // Andi Wijaya (thread author)
                'child_id' => 15,
                'parent_id' => 15,
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days 12 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-4 days 12 hours')),
            ],
            
            // Replies for Thread 8 (Figma vs XD)
            [
                'content' => '<p>Saya switch dari XD ke Figma tahun lalu dan gak nyesel. Main reasons:</p>
<ol>
<li><strong>Real-time collaboration</strong> - game changer untuk remote team</li>
<li><strong>Plugin ecosystem</strong> - jauh lebih rich</li>
<li><strong>Dev handoff</strong> - developer love Figma inspect feature</li>
<li><strong>Community</strong> - banyak free resources & templates</li>
</ol>
<p>Free tier-nya cukup kok untuk freelancer (3 projects).</p>',
                'approved' => 1,
                'thread_id' => 8,
                'user_id' => 4, // Dinda Pratiwi
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'content' => '<p>One downside Figma: performance dengan file super besar. Tapi untuk most use cases, Figma > XD.</p>',
                'approved' => 1,
                'thread_id' => 8,
                'user_id' => 14, // Rina Anggraini
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days 6 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days 6 hours')),
            ],
            
            // Replies for Thread 10 (Git merge conflict)
            [
                'content' => '<p>Git conflict memang tricky di awal. Tips:</p>
<ol>
<li><strong>Understand the markers:</strong>
   <ul>
   <li><code>&lt;&lt;&lt;&lt;&lt;&lt;&lt; HEAD</code> = your current branch changes</li>
   <li><code>=======</code> = separator</li>
   <li><code>&gt;&gt;&gt;&gt;&gt;&gt;&gt; branch-name</code> = incoming changes</li>
   </ul>
</li>
<li><strong>VSCode built-in sudah OK</strong> untuk simple conflicts</li>
<li><strong>Untuk conflicts banyak:</strong> pakai GitKraken atau SourceTree</li>
</ol>
<p>Pro tip: selalu <code>git pull</code> sebelum mulai coding untuk minimize conflicts!</p>',
                'approved' => 1,
                'thread_id' => 10,
                'user_id' => 13, // Hendra Setiawan
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'content' => '<p>Saya pakai extension "Git Graph" di VSCode. Visual representation-nya helpful banget untuk understand conflict.</p>',
                'approved' => 1,
                'thread_id' => 10,
                'user_id' => 3, // Ahmad Fauzan
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day 6 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day 6 hours')),
            ],
            
            // Reply for Thread 11 (Rate limiting)
            [
                'content' => '<p>Untuk Express.js, <code>express-rate-limit</code> sudah cukup untuk basic needs:</p>
<pre><code class="language-javascript">const rateLimit = require(\'express-rate-limit\');

const loginLimiter = rateLimit({
    windowMs: 15 * 60 * 1000, // 15 minutes
    max: 5, // 5 requests per window
    message: \'Too many login attempts, please try again later\'
});

app.post(\'/api/login\', loginLimiter, loginController);</code></pre>
<p>Untuk production dengan multiple servers, better pakai Redis-based limiter.</p>',
                'approved' => 1,
                'thread_id' => 11,
                'user_id' => 15, // Arif Rahman
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-18 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-18 hours')),
            ],
            
            // Reply for Thread 12 (Flutter vs React Native)
            [
                'content' => '<p>Dengan 3-month timeline dan JavaScript background, saya vote <strong>React Native</strong>.</p>
<p>Learning Dart dari scratch akan makan waktu minimal 2-3 minggu. Lebih baik maksimalkan productivity dengan tech yang team sudah familiar.</p>
<p>Performance concern React Native mostly solved di latest version. Dan untuk MVP, performance difference tidak significant.</p>',
                'approved' => 1,
                'thread_id' => 12,
                'user_id' => 8, // Dewi Lestari
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-10 hours')),
            ],
            [
                'content' => '<p>Counter opinion: Flutter development speed lebih cepat karena hot reload dan UI consistency. 3 minggu belajar Dart worth it untuk long-term maintainability.</p>
<p>But yeah, untuk tight deadline, React Native safer choice.</p>',
                'approved' => 1,
                'thread_id' => 12,
                'user_id' => 6, // Nabila Putri
                'child_id' => 23,
                'parent_id' => 23,
                'created_at' => date('Y-m-d H:i:s', strtotime('-8 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-8 hours')),
            ],
            
            // Reply for Thread 13 (CI/CD)
            [
                'content' => '<p>GitHub Actions tidak se-complicated itu kok. Sample workflow untuk deploy ke VPS:</p>
<pre><code class="language-yaml">name: Deploy to VPS

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      
      - name: Run tests
        run: npm test
        
      - name: Deploy via SSH
        uses: appleboy/ssh-action@master
        with:
          host: ${{ secrets.HOST }}
          username: ${{ secrets.USERNAME }}
          key: ${{ secrets.SSH_KEY }}
          script: |
            cd /var/www/app
            git pull
            npm install
            pm2 restart app</code></pre>
<p>Simple dan straightforward!</p>',
                'approved' => 1,
                'thread_id' => 13,
                'user_id' => 7, // Fajar Hidayat
                'child_id' => null,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-4 hours')),
            ],
        ];

        // Insert replies directly to avoid Tatter\Relations compatibility issue
        $db->table('replies')->insertBatch($replies);
    }
}
