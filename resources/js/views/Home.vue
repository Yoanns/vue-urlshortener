<template>
    <div>

        <form @submit.prevent="onSubmit($event)">
          <div class="form-group">
              <input id="original_link" />
          </div>

          <div class="form-group">
              <button type="submit" >
                  Shorten
              </button>
          </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                saving: false,
                message: false,
                url: {
                    original_link: ''
                }
            }
        },
        methods: {
            onSubmit($event) {
                this.saving = true
            }
        }
    }
</script>
