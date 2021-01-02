import { shallowMount, createLocalVue } from '@vue/test-utils'
import VueRouter from 'vue-router'
import App from '../resources/js/views/App.vue'


const localVue = createLocalVue()
localVue.use(VueRouter)

const route = [{ path: '/', component: App }]

const router = new VueRouter({route})

describe('App', () => {
    it('renders a div', () => {
        const wrapper = shallowMount(App, {
            localVue,
            router
          })
      expect(wrapper.get('.container'))
    })

    it('does not display the div #result', () => {
        const wrapper = shallowMount(App, {
            localVue,
            router
          })
      expect(wrapper.get('#result'))
      .to.throw()
      .with.property(
        'message',
        'Unable to find #result within: <div class=".container">...</div>')
    })
  })
