<?php

namespace App\Models;

use App\Models\ReplyModel;
use App\Entities\Thread;
use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class ThreadModel extends Model
{
    use ModelTrait;

    protected $table            = 'threads';
    // protected $with             = ['users', 'thread_categories', 'thread_tags', 'replies'];
    protected $returnType       = Thread::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = ['title', 'slug', 'content', 'views', 'status', 'user_id'];
    
    /**
     * Sync related category
     *
     * @param  mixed $thread_id
     * @param  mixed $category_id
     * @return void
     */
    public function syncCategories($thread_id, $category_id)
    {
        $this->db->table('thread_categories')->where('thread_id', $thread_id)->delete();

        $this->db->table('thread_categories')->insert([
            'thread_id' => $thread_id,
            'category_id' => $category_id
        ]);
    }
    
    /**
     * If tag not exist, insert new tag
     *
     * @param  mixed $name
     * @return void
     */
    public function tagNotExist($name)
    {
        $check = $this->db->table('tags')->where('slug', slug($name))->get()->getRow();

        if (!$check) {
            $this->db->table('tags')->insert([
                'name' => $name,
                'slug' => slug($name)
            ]);
        }
    }
    
    /**
     * Sync related tags
     *
     * @param  mixed $thread_id
     * @param  mixed $tags
     * @return void
     */
    public function syncTags($thread_id, $tags)
    {
        $this->db->table('thread_tags')->where('thread_id', $thread_id)->delete();

        $dataTags = [];
        foreach ($tags as $tag) {
            $dataTags[] = [
                'thread_id' => $thread_id,
                'tag_id' => $tag
            ];
        }

        $this->db->table('thread_tags')->insertBatch($dataTags);
    }

    /**
     * Delete likes
     * 
     * @param  mixed $thread
     * @return void
     */
    public function deleteLikes($thread_id)
    {
        $this->db->table('likes')
            ->where('model_id', $thread_id)
            ->where('model_class', "App\Models\ThreadModel")
            ->delete();
    }

    /**
     * Delete notifications
     * 
     * @param  mixed $thread
     * @return void
     */
    public function deleteNotifications($thread_id)
    {
        $this->db->table("notifications")
            ->where('model_id', $thread_id)
            ->where('model_class', "App\Models\ThreadModel")
            ->delete();
    }

    /**
     * Delete reports
     * 
     * @param  mixed $thread
     * @return void
     */
    public function deleteReports($thread_id)
    {
        $this->db->table("reports")
            ->where('model_id', $thread_id)
            ->where('model_class', "App\Models\ThreadModel")
            ->delete();
    }

    /**
     * Get Likes
     * 
     * @return object
     */
    public function getLikes($id_model, $class_model)
    {
        return $this->db->table('likes')
            ->where('model_id', $id_model)
            ->where('model_class', $class_model)
            ->get()->getResult();
    }

    /**
     * like or unlike thread
     * 
     * @param int $id_model
     * @param string $class_model
     * @return string
     */
    public function likeOrUnlikeThread($id_model, $class_model)
    {
        $likeRecord = $this->db->table('likes')
            ->where('model_id', $id_model)
            ->where('model_class', $class_model)
            ->where('user_id', auth()->id)
            ->get()->getRow();

        if ($likeRecord) {
            $this->db->table('likes')
                ->where('model_id', $id_model)
                ->where('model_class', $class_model)
                ->where('user_id', auth()->id)
                ->delete();

            return "unlike";
        } else {
            $this->db->table('likes')->insert([
                'user_id' => auth()->id,
                'model_id' => $id_model,
                'model_class' => $class_model,
            ]);

            return "like";
        }
    }

    /**
     * Status published
     * 
     */
    public function published()
    {
        return $this->where('status', 'published');
    }

    /**
     * Status draft
     * 
     */
    public function draft()
    {
        return $this->where('status', 'draft');
    }
    
    /**
     * incrementViews
     *
     * @param  mixed $threadId
     * @return void
     */
    public function incrementViews($threadId)
    {
        $session = session();
        $key = 'viewed_thread_' . $threadId;

        // Check if the thread has been viewed in the current session
        if (!$session->has($key)) {
            // Increment views in the database
            $this->db->table('threads')->where('id', $threadId)->increment('views');
            // Mark the thread as viewed in the current session
            $session->set($key, true);
        }
    }
}
