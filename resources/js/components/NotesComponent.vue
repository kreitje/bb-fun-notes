<template>
    <div class="notes-container">
        <div v-if="isLoadingNotes">Fetching notes...</div>
        <div v-if="!isLoadingNotes" v-cloak>
            <note v-for="note in notes" :note="note" :key="note.id" v-on:noteSaved="refreshNotes"></note>

            <div v-if="!hasNewNote" class="add-new-note-block">
                <button type="button" v-on:click="addNewNote">
                    <div class="icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    Add New Note
                </button>
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
            this.refreshNotes();
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
            },

            refreshNotes() {
                this.isLoadingNotes = true;
                axios.get('/?withAjax=1').then((response) => {
                    this.notes = response.data;
                    this.isLoadingNotes = false;

                    if (this.notes.length === 0) {
                        this.addNewNote();
                    }
                });
            }
        }
    }
</script>
