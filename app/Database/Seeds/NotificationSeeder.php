<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        $notifications = [
            // Notifications for thread replies (type: t_reply)
            // Thread 1 notifications - Ahmad Fauzan gets notified
            [
                'user_id' => 3, // Ahmad Fauzan (thread owner)
                'model_id' => 1, // Reply ID
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-14 days 6 hours')), // read
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 days 8 hours')),
            ],
            [
                'user_id' => 3,
                'model_id' => 4, // Another reply
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-13 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-13 days')),
            ],
            
            // Thread 2 notifications - Dinda Pratiwi gets notified
            [
                'user_id' => 4, // Dinda Pratiwi (thread owner)
                'model_id' => 5,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-11 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-11 days')),
            ],
            [
                'user_id' => 4,
                'model_id' => 6,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-11 days 6 hours')),
            ],
            [
                'user_id' => 4,
                'model_id' => 7,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => null, // unread
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
            
            // Thread 3 notifications - Rizky Ramadhan gets notified
            [
                'user_id' => 5, // Rizky Ramadhan (thread owner)
                'model_id' => 8,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-10 days 12 hours')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days 18 hours')),
            ],
            [
                'user_id' => 5,
                'model_id' => 10,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-9 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-9 days 2 hours')),
            ],
            
            // Thread 4 notifications - Fajar Hidayat gets notified
            [
                'user_id' => 7, // Fajar Hidayat (thread owner)
                'model_id' => 11,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],
            [
                'user_id' => 7,
                'model_id' => 12,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
            
            // Thread 5 notifications - Nabila Putri gets notified
            [
                'user_id' => 6, // Nabila Putri (thread owner)
                'model_id' => 13,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
            [
                'user_id' => 6,
                'model_id' => 14,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => null, // unread
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            
            // Thread 7 notifications - Andi Wijaya gets notified
            [
                'user_id' => 9, // Andi Wijaya (thread owner)
                'model_id' => 15,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-4 days 6 hours')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'user_id' => 9,
                'model_id' => 16,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days 12 hours')),
            ],
            
            // Thread 8 notifications - Maya Safitri gets notified
            [
                'user_id' => 10, // Maya Safitri (thread owner)
                'model_id' => 17,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'user_id' => 10,
                'model_id' => 18,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => null, // unread
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days 6 hours')),
            ],
            
            // Thread 10 notifications - Intan Permata gets notified
            [
                'user_id' => 12, // Intan Permata (thread owner)
                'model_id' => 19,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'user_id' => 12,
                'model_id' => 20,
                'model_class' => 'App\Models\ReplyModel',
                'type' => 't_reply',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-20 hours')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day 6 hours')),
            ],
            
            // Notifications for thread likes (type: t_like)
            // Some users get notified when their threads are liked
            [
                'user_id' => 3, // Ahmad Fauzan - thread 1 liked
                'model_id' => 1, // Thread ID
                'model_class' => 'App\Models\ThreadModel',
                'type' => 't_like',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-13 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 days')),
            ],
            [
                'user_id' => 4, // Dinda - thread 2 liked
                'model_id' => 2,
                'model_class' => 'App\Models\ThreadModel',
                'type' => 't_like',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-11 days')),
            ],
            [
                'user_id' => 5, // Rizky - thread 3 liked (most popular)
                'model_id' => 3,
                'model_class' => 'App\Models\ThreadModel',
                'type' => 't_like',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-9 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
            [
                'user_id' => 7, // Fajar - tutorial thread liked
                'model_id' => 4,
                'model_class' => 'App\Models\ThreadModel',
                'type' => 't_like',
                'readed_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-8 days')),
            ],
            [
                'user_id' => 9, // Andi - thread 7 liked
                'model_id' => 7,
                'model_class' => 'App\Models\ThreadModel',
                'type' => 't_like',
                'readed_at' => null, // unread
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'user_id' => 12, // Intan - thread 10 liked
                'model_id' => 10,
                'model_class' => 'App\Models\ThreadModel',
                'type' => 't_like',
                'readed_at' => null, // unread
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
        ];
        
        $db->table('notifications')->insertBatch($notifications);
    }
}
