<?php

namespace App\Models;

use App\Entities\Reply;
use CodeIgniter\Model;

class ReplyModel extends Model
{
    protected $table            = 'replies';
    protected $returnType       = Reply::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'content', 'approved', 'thread_id', 'user_id', 'parent_id', 'child_id'
    ];

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
     * Delete likes
     * 
     * @param  mixed $reply
     * @return void
     */
    public function deleteLikes($reply)
    {
        $this->db->table('likes')
            ->where('model_id', $reply->id)
            ->where('model_class', "App\Models\ReplyModel")
            ->delete();
    }
}
