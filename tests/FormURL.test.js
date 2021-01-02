jest.mock('axios', () => ({
    post: jest.fn()
  }))

import { shallowMount, createLocalVue } from '@vue/test-utils'
import VueRouter from 'vue-router'
import FormURL from '../resources/js/views/FormURL.vue'
import axios from 'axios'


const localVue = createLocalVue()
localVue.use(VueRouter)

const routes = [{ path: '/', component: FormURL }]

const router = new VueRouter({routes})

describe('Form.test.js', () => {
    let cmp;

    beforeEach(() => {
        cmp = shallowMount(FormURL, {
            methods: {
                onSubmit() {
                    axios.post('api/shorten')
                }
            }
        });
        jest.resetModules()
        jest.clearAllMocks()
    });

    it('renders a div', () => {
        const wrapper = shallowMount(FormURL, {
            localVue,
            router
          })
      expect(wrapper.get('div'))
    })

    it('Calls axios.post', () => {
        cmp.vm.onSubmit()
        expect(axios.post).toBeCalledWith('api/shorten')
      })

})
