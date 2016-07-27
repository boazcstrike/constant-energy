$('#itemtable').Tabledit({
    url: 'js/TableEditDisabled.php',
    deleteButton: true,
    saveButton: true,
    autoFocus: false,
    buttons: {
        edit: {
            class: 'btn btn-sm btn-primary',
            html: '<span class="glyphicon glyphicon-pencil"></span> &nbsp Edit',
            action: 'edit'
        },
	delete: {
        class: 'btn btn-sm btn-success',
        html: '<span class="glyphicon glyphicon-repeat"></span>',
        action: 'restore'
		},
    },
    columns: {
        identifier: [0, 'id'],
        editable: [[1, 'item_name'], [2, 'item_code'],[4, 'amount'], [6,'desc'] ]
    },
    onDraw: function() {
        console.log('onDraw()');
    }
});