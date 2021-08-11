export default function({ $axios, store }) {
  $axios.onError(error => {
    if (error.response.status === 422) {
      store.commit('alert/show', {
        show: true,
        content: error.response.data.message,
        style: 'danger',
        errors: Object.values(error.response.data.errors).length
          ? error.response.data.errors
          : {}
      })
    }

    // return Promise.reject(error)
  })
  $axios.onResponse(res => {
    res.data.status = res.status
    return res
  })
}
