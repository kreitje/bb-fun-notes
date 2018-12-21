<template>
    <div class="container">
        <div v-if="isLoadingNotes">Fetching notes...</div>
        <div v-if="!isLoadingNotes" v-cloak>
            <note v-for="note in notes" :note="note" :key="note.id"></note>

            <div v-if="!hasNewNote" class="add-new-note-block">
                <button v-on:click="addNewNote">Add New Note</button>
            </div>
        </div>
    </div>
</template>

<script>
    import note from './NoteComponent';
    export default {
        components: {
            note
        },

        data() {
            return {
                isLoadingNotes: false,
                notes: []
            }
        },

        mounted() {
            this.isLoadingNotes = true;
            axios.get('/?withAjax=1').then((response) => {
                this.notes = response.data;
                this.isLoadingNotes = false;

                if (this.notes.length === 0) {

                    this.addNewNote();
                }
            });
        },

        computed: {
            hasNewNote() {
                return this.notes.filter((note) => {
                    return note.id === 0;
                }).length > 0;
            }
        },

        methods: {
            addNewNote() {
                let newNote = {
                    id: 0,
                    note: '',
                    color: 'orange'
                };

                this.notes.push(newNote);
            }
        }
    }
</script>
