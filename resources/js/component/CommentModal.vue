<template>
  <div class="comment-modal">
    <div class="modal-content">
      <button @click="$emit('close')" class="close-btn">X</button>

      <!-- show  comments-->
      <div v-if="comments && comments.length" class="comments-list">
        <div v-for="comment in comments" :key="comment.id" class="comment">
          <p><strong>{{ comment.user_name }}:</strong> {{ comment.content }}</p>

          <!-- Options for comment -->
          <div class="dots-menu" @click="toggleMenuComment(comment.id)">
            <span class="dot">...</span>
          </div>
          <!-- Delete of update-->
          <div v-if="activeMenuComment == comment.id && $root.user[0].id == comment.user_id" class="comment-options">
            <button @click="startEditComment(comment)" class="edit-btn">Edit</button>
            <button @click="confirmDeleteComment(comment)" class="delete-btn">Delete</button>
            <button @click="startReply(comment)" class="reply-btn">Reply</button>
          </div>

          <!-- show place to write the reply   -->
          <div v-if="replyingCommentId === comment.id" class="reply-section">
            <textarea v-model="replyContent" rows="3" placeholder="Write a reply..."></textarea>
            <button @click="submitReply(comment.id)" :disabled="!replyContent" class="reply-btn">Post Reply</button>
          </div>

          <!-- show replies -->
          <div v-if="comment.replies && comment.replies.length" class="replies">
            <div v-for="reply in comment.replies" :key="reply.id" class="reply">
              <p><strong>{{ reply.user_name }}:</strong> {{ reply.content }}</p>

              <div class="dots-menu-reply" @click="toggleMenuReply(reply.id)">
                <div class="dot-reply">...</div>
              </div>
              <!-- Options for reply -->
              <div v-if="activeMenuReply === reply.id && $root.user[0].id == reply.user_id" class="reply-options">
                <button @click="startEditReply(reply, comment)" class="edit-btn-reply">Edit</button>
                <button @click="confirmDeleteReply(comment, reply)" class="delete-btn-reply">Delete</button>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- show place to write the edited comment -->
      <div v-show="isEditing" class="edit-comment-modal">
        <textarea v-model="editContent" rows="4"></textarea>
        <div class="modal-footer">
          <button @click="updateComment" :disabled="!editContent" class="save-btn">Save</button>
          <button @click="cancelEdit" class="cancel-btn">Cancel</button>
        </div>
      </div>

      <!-- show place to write the edited reply -->
      <div v-show="isEditingReply" class="edit-reply-modal">
        <textarea v-model="editReplyContent" rows="4"></textarea>
        <div class="modal-footer">
          <button @click="updateReply" :disabled="!editReplyContent" class="save-btn">Save</button>
          <button @click="cancelEdit" class="cancel-btn">Cancel</button>
        </div>
      </div>

      <!-- delete confirmation-->
      <div v-if="isConfirmingDelete" class="confirm-delete-modal">
        <p style="color: red; margin: 5px;"> Are you sure you want to delete this comment?</p>
        <button @click="deleteComment" class="confirm-btn">Yes, Delete</button>
        <button @click="cancelDelete" class="cancel-btn">Cancel</button>
      </div>
      <div v-if="isConfirmingDeleteReply" class="confirm-delete-modal">
        <p style="color: red; margin: 5px;">Are you sure you want to delete this Reply?</p>
        <button @click="deleteReply" class="confirm-btn">Yes, Delete</button>
        <button @click="cancelDelete" class="cancel-btn">Cancel</button>
      </div>

      <h3>Write a Comment</h3>
      <!-- Write the comment -->
      <div class="comment-input">
        <textarea v-model="commentContent" placeholder="Write a comment..." rows="4"></textarea>
        <div class="modal-footer">
          <button @click="submitComment" :disabled="!commentContent" class="post-btn">
            Post Comment
          </button>
        </div>
      </div>

    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  props: {
    postId: {
      type: Number,
      required: true
    },
    comments: {
      type: Array,
      default: () => []
    },
    currentUserName: {
      type: String,
      required: true
    },
  },
  data() {
    return {
      commentContent: '',
      editContent: '',
      editingCommentId: null,
      isEditing: false,
      isConfirmingDelete: false,
      commentToDeleteId: null,
      activeMenuReply: null,
      activeMenuComment: null,
      replyContent: '',
      replyingCommentId: null,
      isEditingReply: false,
      editReplyContent: '',
      editingReplyId: null,
      ReplyComment: null,
      isConfirmingDeleteReply: false,
      commentReplyToDeleteId: null,
      ReplyToDeleteId: null,
    };
  },
  methods: {
    startReply(comment) {

      this.replyingCommentId = comment.id;
    },
    submitReply(replyingCommentId) {
      if (!this.replyContent) return;

      console.log("Post ID:", this.postId);
      console.log("Reply Content:", this.replyContent);


      axios.post(`/api/comments/${this.replyingCommentId}/replies`, {
        comment_id: replyingCommentId,
        content: this.replyContent
      })
        .then(response => {
          console.log('Reply added response:', response.data);


          const comment = this.comments.find(c => c.id === replyingCommentId);
          if (comment) {
            comment.replies = comment.replies || [];
            comment.replies.push({
              id: response.data.id,
              content: this.replyContent,
              user_name: this.currentUserName,
              user_id: this.$root.user[0].id,
              created_at: new Date().toISOString()
            });
          }

          this.replyContent = '';
          this.replyingCommentId = null;
        })
        .catch(error => {
          console.error('Error posting reply:', error);
          alert('Error posting reply, please try again.');
        });
    },

    startEditReply(reply, comment) {
      this.isEditingReply = true;
      this.editReplyContent = reply.content;
      this.editingReplyId = reply.id;
      this.ReplyComment = comment.id;
    },
    updateReply() {
      if (!this.editReplyContent) return;


      axios.put(`/api/comments/replies/${this.editingReplyId}`, { content: this.editReplyContent })
        .then(response => {
          console.log('Reply updated:', response.data);


          const comment = this.comments.find(c => c.id === this.ReplyComment);
          if (comment) {

            const reply = comment.replies.find(r => r.id === this.editingReplyId);
            if (reply) {
              reply.content = this.editReplyContent;
            }
          }

          this.isEditingReply = false;
          this.editReplyContent = '';
        })
        .catch(error => {
          console.error('Error updating Reply:', error);
          alert('Error updating Reply, please try again.');
        });
    },
    confirmDeleteReply(comment, reply) {
      this.isConfirmingDeleteReply = true;
      this.commentReplyToDeleteId = comment.id;
      this.ReplyToDeleteId = reply.id;
    },

    deleteReply() {
      if (this.ReplyToDeleteId && this.commentReplyToDeleteId) {
        console.log(`/api/comments/${this.commentReplyToDeleteId}/replies/${this.ReplyToDeleteId}`);


        axios.delete(`/api/comments/replies/${this.ReplyToDeleteId}`)
          .then(() => {
            console.log('Reply deleted successfully.');


            const comment = this.comments.find(comment => comment.id === this.commentReplyToDeleteId);
            if (comment) {

              const replyIndex = comment.replies.findIndex(reply => reply.id === this.ReplyToDeleteId);
              if (replyIndex !== -1) {
                comment.replies.splice(replyIndex, 1);
              }
            }


            this.isConfirmingDeleteReply = false;
            this.ReplyToDeleteId = null;
            this.commentReplyToDeleteId = null;
          })
          .catch(error => {
            console.error('Error deleting reply:', error);
            alert('Error deleting reply, please try again.');
          });
      }
    },



    toggleMenuReply(Id) {
      this.activeMenuReply = this.activeMenuReply === Id ? null : Id;
      this.activeMenuComment = null;
    },

    toggleMenuComment(Id) {
      this.activeMenuComment = this.activeMenuComment === Id ? null : Id;
      this.activeMenuReply = null;
    },
    submitComment() {
      if (!this.commentContent) return;

      console.log("Post ID:", this.postId);
      console.log("Comment Content:", this.commentContent);


      axios.post('/api/comments', {
        post_id: this.postId,
        content: this.commentContent
      })
        .then(response => {
          console.log('Comment added response:', response.data);
          this.comments.unshift({
            id: response.data.id,
            content: this.commentContent,
            user_name: this.currentUserName,
            user_id: this.$root.user[0].id,
            created_at: new Date().toISOString()
          });
          if (this.activeMenuComment) {
            this.activeMenuComment = null;
          }
          if (this.activeMenuReply) {
            this.activeMenuReply = null;
          }
          this.commentContent = '';
          this.$emit('comment-added', response.data);
          console.log(this.comments);
        })
        .catch(error => {
          console.error('Error posting comment:', error);
          alert('Error posting comment, please try again.');
        });
    },



    startEditComment(comment) {
      this.isEditing = true;
      this.editContent = comment.content;
      this.editingCommentId = comment.id;
    },


    updateComment() {
      if (!this.editContent) return;

      axios.put(`/api/comments/${this.editingCommentId}`, { content: this.editContent })
        .then(response => {
          console.log('Comment updated:', response.data);


          const comment = this.comments.find(c => c.id === this.editingCommentId);
          if (comment) {
            comment.content = this.editContent;
          }

          this.isEditing = false;
          this.editContent = '';
        })
        .catch(error => {
          console.error('Error updating comment:', error);
          alert('Error updating comment, please try again.');
        });
    },

    cancelEdit() {
      this.isEditing = false;
      this.editContent = ''; // مسح المحتوى عند إلغاء التعديل
      this.isEditingReply = false;
      this.editReplyContent = '';
    },

    confirmDeleteComment(comment) {
      this.isConfirmingDelete = true;
      this.commentToDeleteId = comment.id;
    },

    deleteComment() {
      if (this.commentToDeleteId) {
        axios.delete(`/api/comments/${this.commentToDeleteId}`)
          .then(() => {
            console.log('Comment deleted successfully.');


            const index = this.comments.findIndex(comment => comment.id === this.commentToDeleteId);
            if (index !== -1) {
              this.comments.splice(index, 1);
            }


            this.isConfirmingDelete = false;
            this.commentToDeleteId = null;
          })
          .catch(error => {
            console.error('Error deleting comment:', error);
            alert('Error deleting comment, please try again.');
          });
      }
    },




    cancelDelete() {
      this.isConfirmingDelete = false;
      this.isConfirmingDeleteReply = false;
      this.commentToDeleteId = null;

    }
  }
};
</script>

<style scoped>
.comment-modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: transparent;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  padding: 10px;
  transition: opacity 0.3s ease-in-out;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  width: 400px;
  max-width: 100%;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  position: relative;
  transition: transform 0.3s ease-in-out;
}

.close-btn {
  background: none;
  border: none;
  font-size: 20px;
  font-weight: bold;
  position: absolute;
  top: 10px;
  right: 10px;
  color: #007bff;
  cursor: pointer;
  z-index: 1000;
}

.close-btn:hover {
  color: #0056b3;
}


.comments-list {
  margin-bottom: 20px;
}

.comment {
  margin-bottom: 10px;
  padding: 10px;
  background-color: #f9f9f9;
  border-radius: 5px;
  position: relative;
  font-size: 14px;
}

.comment:hover {
  background-color: #f1f1f1;
}


.dots-menu {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}

.dots-menu-reply {
  position: relative;

  cursor: pointer;
}

.dot {
  font-size: 18px;
  font-weight: bold;
  color: #2e2be6;
}

.dot-reply {
  position: absolute;
  font-size: 18px;
  font-weight: bold;
  color: #2e2be6;
  bottom: 5px;
  right: 10px;
}

.dot:hover {
  color: #003166;
}


.edit-btn,
.delete-btn {
  margin-left: 10px;
  padding: 5px 10px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s ease;
}

.edit-btn-reply,
.delete-btn-reply {
  margin-left: 10px;
  padding: 5px 10px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s ease;


}

.edit-btn,
.edit-btn-reply {
  background-color: #007bff;
  color: white;
  border-radius: 5px;
  border: none;
}

.delete-btn,
.delete-btn-reply {
  background-color: red;
  color: white;
  border-radius: 5px;
  border: none;
}

.edit-btn:hover {
  background-color: #0056b3;
}

.delete-btn:hover {
  background-color: #b32d2e;
}


.edit-comment-modal,
.edit-reply-modal {
  margin-top: 20px;

}

.confirm-delete-modal {
  margin-top: 10px;
  background-color: #cac7c7;
  border-radius: 5px;
}

textarea {
  width: 100%;
  padding: 12px;
  margin-bottom: 20px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 14px;
  outline: none;
  resize: none;
}

textarea:focus {
  border-color: #007bff;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
}

.save-btn,
.confirm-btn,
.cancel-btn {
  padding: 8px 16px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.save-btn:hover,
.confirm-btn:hover,
.cancel-btn:hover {
  background-color: #0056b3;
}

.cancel-btn {
  background-color: #ccc;
  margin: 5px;
}

.save-btn:disabled,
.confirm-btn:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}


.post-btn {
  padding: 8px 16px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

.post-btn:hover {
  background-color: #0056b3;
}

.reply-btn {
  background-color: #126726;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 6px 12px;
  font-size: 14px;
  cursor: pointer;
  margin: 5px;
}

.reply-btn:hover {
  background-color: #11501f;
}

.reply-section {
  margin-top: 10px;
}

.replies {
  margin-top: 10px;
  margin-left: 20px;
}

.reply {
  margin-bottom: 8px;
  padding: 6px;
  background-color: #bebaba;
  border-radius: 4px;
}
</style>
