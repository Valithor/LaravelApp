export const state = () => ({
  show: false,
  content: '',
  style: '',
  errors: {}
})

export const mutations = {
  show(state, alert) {
    state.show = alert.show
    state.content = alert.content
    state.style = alert.style

    state.errors = alert.errors !== undefined ? alert.errors : {}

    window.scrollTo(0, 0)
  },
  destroy(state) {
    state.show = false
    state.content = ''
    state.style = 'success'
    state.errors = {}
  }
}
