<template>
    <div class="center-all">
        <h1 class="text--header">Chezpack file hosting</h1>
        <label for="fileExplorer" class="upload-button">
            <input type="file" id="fileExplorer" style="display:none" @change="handleFileChanges">
            Upload new chezpack version
        </label>
        <hr>
        <h1 style="margin-top: 1rem" class="text--header">Download</h1>
        <h2 class="text--subtitle">Uploaded on {{uploadTime}}</h2>
        <a :href="fileUrl">
            <button class="upload-button">Download {{fileName}}</button>
        </a>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Home",
    data() {
        return {
            selectedFile: [],
            uploadTime: null,
            fileUrl: null,
            fileName: null,
        }
    },
    mounted() {
       this.getChezPack()
    },
    methods: {
        handleFileChanges(event) {
            this.selectedFile = event.target.files[0]
            if (!this.selectedFile) {
                console.error('A file upload was attempted but a file could not be found.')
            }
            const formData = new FormData()
            formData.append('file', this.selectedFile)

            axios.post(`/api/assets/upload`, formData)
                .then(response => {
                    console.log(response)
                    this.uploadTime = response.data.created_at
                })
                .catch(error => {
                    console.error(`Error generated during file upload: ${error}`)
                })
        },
        getChezPack() {
            axios.get(`/api/assets/get`)
                .then(response => {
                    this.uploadTime = response.data.data.created_at
                    this.fileName = response.data.data.file_name

                    this.fileUrl = response.data.fileUrl

                })
                .catch(error => {
                    console.error(`Error generated during file retrieval: ${error}`)
                })
        }
    }
}

</script>

<style scoped lang="scss">
    @import "../../styles/sass/example";
</style>
