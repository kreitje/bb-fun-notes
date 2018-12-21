<template>
    <div class="note" v-bind:id="htmlId" v-bind:class="editableNote.color">
        <button v-on:click="deleteNote" type="button" class="delete"><i class="fas fa-times"></i></button>
        <div class="title">Last updated: <span v-if="!isCreated">never</span><span v-if="isCreated">{{formattedTimeDate}}</span></div>
        <div class="body">
            <textarea v-model="editableNote.note" placeholder="Enter your note here"></textarea>
        </div>

        <select v-model="editableNote.color">
            <option value="blue">Blue</option>
            <option value="black">Black</option>
            <option value="orange">Orange</option>
            <option value="red">Red</option>
            <option value="white">White</option>
        </select>

        <button v-on:click="save" class="btn btn-primary btn-sm float-right" v-bind:disabled="isSavingNote">
            <span v-if="!isSavingNote">Save</span>
            <span v-if="isSavingNote" v-cloak><i class="fas fa-spinner fa-spin"></i></span>
        </button>

    </div>
</template>

<script>
    import moment from 'moment';
    export default {
        props: {
            note: {
                required: true
            }
        },

        data() {
            return {
                isSavingNote: false,
                editableNote: {}
            }
        },

        mounted() {
            this.editableNote = this.note;
        },

        computed: {
            isCreated() {
                return this.note.id !== 0;
            },

            htmlId() {
                return 'note-id-' + this.note.id;
            },

            formattedTimeDate() {
                return moment(this.note.updated_at).fromNow();
            },
        },

        methods: {
            save() {
                let url = '/notes',
                    method = 'POST';

                if (this.isCreated) {
                    url += '/' + this.note.id;
                    method = 'PUT';
                }

                let data = {
                    _method: method,
                    width: 100,
                    height: 100,
                    note: this.editableNote.note,
                    color: this.editableNote.color
                };

                axios.post(url, data).then((response) => {
                    console.log(response);

                    this.isSavingNote = false;
                    this.$emit('noteSaved', response.data);
                });
            },

            deleteNote() {
                if (confirm('Are you sure you want to delete this note?')) {
                    axios.post('/notes/' + this.note.id, {_method: 'DELETE'}).then((response) => {
                        this.isSavingNote = false;
                        this.$emit('noteSaved', response.data);
                    });
                }
            }
        }
    }
</script>
