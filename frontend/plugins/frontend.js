// Tu ładujemy własne js, np korzystające z jquery

// helper żeby korzystać z $:
if (process.client) {
  // const $ = window.$
  // $('body').on('click', '.dropdown-submenu > a', function(e) {
  //   console.log('submenu')
  //   const submenu = $(this)
  //   $('.dropdown-submenu .dropdown-menu').removeClass('show')
  //   submenu.next('.dropdown-menu').addClass('show')
  //   e.stopPropagation()
  // })
  // $('.dropdown').on('hidden.bs.dropdown', function() {
  //   // hide any open menus when parent closes
  //   $('.dropdown-menu.show').removeClass('show')
  // })
}
