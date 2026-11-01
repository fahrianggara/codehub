<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        $likes = [
            // Likes for threads (model_class = App\Models\ThreadModel)
            // Thread 1 - popular thread (8 likes)
            ['user_id' => 4, 'model_id' => 1, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-14 days'))],
            ['user_id' => 5, 'model_id' => 1, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-14 days'))],
            ['user_id' => 6, 'model_id' => 1, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-13 days'))],
            ['user_id' => 8, 'model_id' => 1, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-13 days'))],
            ['user_id' => 9, 'model_id' => 1, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-12 days'))],
            ['user_id' => 10, 'model_id' => 1, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-12 days'))],
            ['user_id' => 13, 'model_id' => 1, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-11 days'))],
            ['user_id' => 15, 'model_id' => 1, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-11 days'))],
            
            // Thread 2 (6 likes)
            ['user_id' => 3, 'model_id' => 2, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-11 days'))],
            ['user_id' => 7, 'model_id' => 2, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-11 days'))],
            ['user_id' => 9, 'model_id' => 2, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
            ['user_id' => 11, 'model_id' => 2, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
            ['user_id' => 13, 'model_id' => 2, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-9 days'))],
            ['user_id' => 15, 'model_id' => 2, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-9 days'))],
            
            // Thread 3 - most popular (12 likes - solved problem)
            ['user_id' => 3, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
            ['user_id' => 4, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
            ['user_id' => 6, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-9 days'))],
            ['user_id' => 7, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-9 days'))],
            ['user_id' => 8, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-9 days'))],
            ['user_id' => 9, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-8 days'))],
            ['user_id' => 10, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-8 days'))],
            ['user_id' => 11, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-8 days'))],
            ['user_id' => 12, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-7 days'))],
            ['user_id' => 13, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-7 days'))],
            ['user_id' => 14, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-6 days'))],
            ['user_id' => 15, 'model_id' => 3, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-6 days'))],
            
            // Thread 4 - tutorial (10 likes)
            ['user_id' => 3, 'model_id' => 4, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-8 days'))],
            ['user_id' => 4, 'model_id' => 4, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-7 days'))],
            ['user_id' => 5, 'model_id' => 4, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-7 days'))],
            ['user_id' => 6, 'model_id' => 4, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-7 days'))],
            ['user_id' => 8, 'model_id' => 4, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-6 days'))],
            ['user_id' => 9, 'model_id' => 4, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-6 days'))],
            ['user_id' => 11, 'model_id' => 4, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-5 days'))],
            ['user_id' => 12, 'model_id' => 4, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-5 days'))],
            ['user_id' => 13, 'model_id' => 4, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-4 days'))],
            ['user_id' => 15, 'model_id' => 4, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-4 days'))],
            
            // Thread 5 (4 likes)
            ['user_id' => 7, 'model_id' => 5, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-6 days'))],
            ['user_id' => 9, 'model_id' => 5, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-6 days'))],
            ['user_id' => 11, 'model_id' => 5, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-5 days'))],
            ['user_id' => 13, 'model_id' => 5, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-5 days'))],
            
            // Thread 7 (9 likes - popular question)
            ['user_id' => 3, 'model_id' => 7, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-5 days'))],
            ['user_id' => 4, 'model_id' => 7, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-4 days'))],
            ['user_id' => 5, 'model_id' => 7, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-4 days'))],
            ['user_id' => 6, 'model_id' => 7, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-4 days'))],
            ['user_id' => 8, 'model_id' => 7, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
            ['user_id' => 10, 'model_id' => 7, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
            ['user_id' => 12, 'model_id' => 7, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
            ['user_id' => 13, 'model_id' => 7, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
            ['user_id' => 15, 'model_id' => 7, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
            
            // Thread 10 (7 likes)
            ['user_id' => 3, 'model_id' => 10, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
            ['user_id' => 5, 'model_id' => 10, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))],
            ['user_id' => 6, 'model_id' => 10, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))],
            ['user_id' => 7, 'model_id' => 10, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))],
            ['user_id' => 9, 'model_id' => 10, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-18 hours'))],
            ['user_id' => 11, 'model_id' => 10, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-18 hours'))],
            ['user_id' => 14, 'model_id' => 10, 'model_class' => 'App\Models\ThreadModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-12 hours'))],
            
            // Likes for replies (model_class = App\Models\ReplyModel)
            // Reply 1 - helpful answer (5 likes)
            ['user_id' => 3, 'model_id' => 1, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-14 days'))],
            ['user_id' => 4, 'model_id' => 1, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-14 days'))],
            ['user_id' => 5, 'model_id' => 1, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-13 days'))],
            ['user_id' => 9, 'model_id' => 1, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-13 days'))],
            ['user_id' => 11, 'model_id' => 1, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-12 days'))],
            
            // Reply 5 - good explanation (7 likes)
            ['user_id' => 4, 'model_id' => 5, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-11 days'))],
            ['user_id' => 6, 'model_id' => 5, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-11 days'))],
            ['user_id' => 7, 'model_id' => 5, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
            ['user_id' => 8, 'model_id' => 5, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
            ['user_id' => 10, 'model_id' => 5, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
            ['user_id' => 13, 'model_id' => 5, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-9 days'))],
            ['user_id' => 15, 'model_id' => 5, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-9 days'))],
            
            // Reply 8 - solution (9 likes - solved the problem!)
            ['user_id' => 3, 'model_id' => 8, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
            ['user_id' => 4, 'model_id' => 8, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
            ['user_id' => 5, 'model_id' => 8, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-9 days'))],
            ['user_id' => 6, 'model_id' => 8, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-9 days'))],
            ['user_id' => 7, 'model_id' => 8, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-9 days'))],
            ['user_id' => 8, 'model_id' => 8, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-8 days'))],
            ['user_id' => 9, 'model_id' => 8, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-8 days'))],
            ['user_id' => 12, 'model_id' => 8, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-8 days'))],
            ['user_id' => 14, 'model_id' => 8, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-7 days'))],
            
            // Reply 15 - detailed explanation (8 likes)
            ['user_id' => 6, 'model_id' => 15, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-4 days'))],
            ['user_id' => 7, 'model_id' => 15, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-4 days'))],
            ['user_id' => 8, 'model_id' => 15, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
            ['user_id' => 9, 'model_id' => 15, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
            ['user_id' => 10, 'model_id' => 15, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
            ['user_id' => 12, 'model_id' => 15, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
            ['user_id' => 13, 'model_id' => 15, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
            ['user_id' => 14, 'model_id' => 15, 'model_class' => 'App\Models\ReplyModel', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
        ];
        
        $db->table('likes')->insertBatch($likes);
    }
}
