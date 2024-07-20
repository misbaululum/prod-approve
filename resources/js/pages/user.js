import $ from 'jquery'
import '../vendor/datatable'
import { AjaxAction, HandleFormSubmit } from '../lib/utils'

// window.$ = window.jQuery = $

$('.main-content').on('click', '.action', function (e) {

    if (!this.dataset.action) {
        throw new Error('No action defined');
    }

    (new AjaxAction(this))
    .onSuccess(res => {
      
        (new HandleFormSubmit())
        .onSuccess(res => {
            
        })
        .reloadDatatable('user-table')
        .Init()
    })
    .execute()
})