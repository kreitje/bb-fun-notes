<template>
    <div class="note" v-bind:id="htmlId" v-bind:class="editableNote.color">
        <div class="title">Last updated: <span v-if="!isCreated">never</span></div>
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

        <button v-on:click="save" class="btn btn-primary btn-sm float-right">Save</button>
    </div>
</template>

<script>
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
            }
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
                    note: this.editableNote.note,
                    width: 100,
                    height: 100
                };

                axios.post(url, data).then((response) => {
                    console.log(response);

                    this.isSavingNote = false;
                    this.$emit('noteSaved', response.data);
                })
            }
        }
    }
</script>
