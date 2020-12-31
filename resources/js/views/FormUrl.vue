<template>
    <div>
        <div class="row" >
            <form @submit.prevent="onSubmit" class="row m-3">
                <div class="form-group">
                    <div class="row m-3 align-items-center" >

                        <div class="input-group mb-2">
                            <input
                                name="original_link"
                                type="URL"
                                v-model="form.original_link"
                                required
                                placeholder="Please enter the URL to shorten"
                                class="form-control" />

                            <button class="btn btn-outline-secondary blue" type="submit" >
                                Shorten
                            </button>

                        </div>

                    </div>
                </div>
            </form>
        </div>

        <div id="result" v-if="active" class="row m-3">
            <div class="text-center py-3">
                <p>The link <code class=".fw-bold "> {{ url }} </code> has been shortened to : </p>
                <a :href="code" target="new"> {{ short_link }} </a>
            </div>
        </div>

    </div>

</template>

<script>
    import axios from 'axios';
    import Form from 'vform'

    export default {
        data() {
            return {
                active: false,
                short_link: '',
                code: '',
                url:'',
                form: new Form({
                    original_link: ''
                })
            }
        },
        methods: {
            onSubmit() {
                this.form.post('api/shorten')
                .then((data) => {
                    this.short_link = data.data['short_link'];
                    this.code = data.data['code'];
                });
                this.url = this.form.original_link;
                this.active = true;
                this.form.reset();
            }
        }
    }
</script>
