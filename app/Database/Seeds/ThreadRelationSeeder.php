<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ThreadRelationSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // Thread-Category relations (each thread has 1 category)
        $threadCategories = [
            ['thread_id' => 1, 'category_id' => 1],  // Asking
            ['thread_id' => 2, 'category_id' => 10], // Tips & Trick
            ['thread_id' => 3, 'category_id' => 3],  // Fixing Bug
            ['thread_id' => 4, 'category_id' => 11], // Tutorial
            ['thread_id' => 5, 'category_id' => 5],  // Machine Learning
            ['thread_id' => 6, 'category_id' => 7],  // Framework
            ['thread_id' => 7, 'category_id' => 6],  // Bahasa Pemrograman
            ['thread_id' => 8, 'category_id' => 8],  // UI/UX
            ['thread_id' => 9, 'category_id' => 1],  // Asking
            ['thread_id' => 10, 'category_id' => 10], // Tips & Trick
            ['thread_id' => 11, 'category_id' => 9],  // Web Development
            ['thread_id' => 12, 'category_id' => 1],  // Asking
            ['thread_id' => 13, 'category_id' => 10], // Tips & Trick
            ['thread_id' => 14, 'category_id' => 11], // Tutorial (draft)
        ];
        
        $db->table('thread_categories')->insertBatch($threadCategories);
        
        // Thread-Tag relations (threads can have multiple tags)
        $threadTags = [
            // Thread 1: Laravel optimization
            ['thread_id' => 1, 'tag_id' => 7],  // php
            ['thread_id' => 1, 'tag_id' => 21], // laravel
            ['thread_id' => 1, 'tag_id' => 6],  // framework
            
            // Thread 2: React state management
            ['thread_id' => 2, 'tag_id' => 8],  // javascript
            ['thread_id' => 2, 'tag_id' => 19], // react
            ['thread_id' => 2, 'tag_id' => 3],  // tips & trick
            
            // Thread 3: CORS error
            ['thread_id' => 3, 'tag_id' => 8],  // javascript
            ['thread_id' => 3, 'tag_id' => 26], // express
            ['thread_id' => 3, 'tag_id' => 5],  // bug
            
            // Thread 4: JWT Tutorial
            ['thread_id' => 4, 'tag_id' => 7],  // php
            ['thread_id' => 4, 'tag_id' => 22], // codeigniter
            ['thread_id' => 4, 'tag_id' => 3],  // tips & trick
            
            // Thread 5: Python NLP
            ['thread_id' => 5, 'tag_id' => 9],  // python
            ['thread_id' => 5, 'tag_id' => 1],  // ngoding
            
            // Thread 6: Flutter Riverpod
            ['thread_id' => 6, 'tag_id' => 17], // dart
            ['thread_id' => 6, 'tag_id' => 18], // flutter
            
            // Thread 7: var, let, const
            ['thread_id' => 7, 'tag_id' => 8],  // javascript
            ['thread_id' => 7, 'tag_id' => 1],  // ngoding
            
            // Thread 8: Figma vs XD
            ['thread_id' => 8, 'tag_id' => 3],  // tips & trick
            
            // Thread 9: MySQL vs PostgreSQL
            ['thread_id' => 9, 'tag_id' => 1],  // ngoding
            
            // Thread 10: Git merge conflict
            ['thread_id' => 10, 'tag_id' => 3],  // tips & trick
            ['thread_id' => 10, 'tag_id' => 5],  // bug
            
            // Thread 11: Rate limiting
            ['thread_id' => 11, 'tag_id' => 8],  // javascript
            ['thread_id' => 11, 'tag_id' => 26], // express
            
            // Thread 12: Flutter vs React Native
            ['thread_id' => 12, 'tag_id' => 18], // flutter
            ['thread_id' => 12, 'tag_id' => 19], // react
            ['thread_id' => 12, 'tag_id' => 1],  // ngoding
            
            // Thread 13: CI/CD
            ['thread_id' => 13, 'tag_id' => 3],  // tips & trick
            
            // Thread 14: Draft thread
            ['thread_id' => 14, 'tag_id' => 8],  // javascript
            ['thread_id' => 14, 'tag_id' => 3],  // tips & trick
        ];
        
        $db->table('thread_tags')->insertBatch($threadTags);
    }
}
