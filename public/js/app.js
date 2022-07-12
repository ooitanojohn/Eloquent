// add modal
var ModalDelete = document.getElementById('Modal-delete')
ModalDelete.addEventListener('show.coreui.modal', function (event) {
  var button = event.relatedTarget
  var selectId = button.getAttribute('data-coreui-whatever')
  var url = button.getAttribute('value')
  // console.log(url)

  var modalTitle = ModalDelete.querySelector('.modal-title')
  var modalBodyInput = ModalDelete.querySelector('.modal-body input')

//   modalTitle.textContent = selectId +'を本当に削除しますか？'
   var form = ModalDelete.querySelector('form')
   // console.log(form.action)
  form.action = url + selectId + '/destroy'

})