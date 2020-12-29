<template>
    <div>
        <form @submit.prevent="onSubmit">
          <div class="form-group">
              <input
                name="original_link"
                type="URL"
                v-model="form.original_link"
                required
                placeholder="Please enter URL to shorten" />

              <button type="submit" >
                  Shorten
              </button>
          </div>
        </form>

        <a :href="code"> {{ short_link }} </a>

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
                this.active = true;
                this.form.reset();
            }
        }
    }
</script>
