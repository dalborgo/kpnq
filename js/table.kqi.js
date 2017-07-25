/*
 * Editor client script for DB table kqi
 * Created by http://editor.datatables.net/generator
 */

(function ($) {

    $(document).ready(function () {
        var editor = new $.fn.dataTable.Editor({
            ajax: {
                url: 'php/table.kqi.php',
                type: "POST",
                data: function (d) {
                    d.ci = cid;
                }
            },
            table: '#kqi',
            i18n: {
                "create": {
                    "button": "Nuovo",
                    "title":  "Crea nuova riga",
                    "submit": "Crea"
                },
                "edit": {
                    "button": "Modifica",
                    "title":  "Modifica riga",
                    "submit": "Aggiorna"
                },
                "remove": {
                    "button": "Elimina",
                    "title":  "Elimina riga",
                    "submit": "Elimina",
                    "confirm": {
                        "_": "Sei sicura di voler eliminare %d righe?",
                        "1": "Sei sicura di voler eliminare la riga?"
                    }
                },
                "error": {
                    "system": "Si è verificato un errore (Maggiori informazioni)"
                },
                "multi": {
                    "title": "Multiple values",
                    "info": "The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.",
                    "restore": "Undo changes",
                    "noMulti": "This input can be edited individually, but not part of a group."
                },
                "datetime": {
                    "previous": 'Precedente',
                    "next":     'Successivo',
                    "months":   [ 'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre' ],
                    "weekdays": [ 'Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab' ],
                    "amPm":     [ 'am', 'pm' ],
                    "unknown":  '-'
                }
            },
            fields: [
                {
                    "label": "data:",
                    "name": "data",
                    "type": "datetime",
                    "format": "YYYY-MM-DD HH:mm:ss"
                },
                {
                    "label": "prepagato:",
                    "name": "prepagato"
                },
                {
                    "label": "costo_totale:",
                    "name": "costo_totale"
                },
                {
                    "label": "cliente_id:",
                    "name": "cliente_id",
                    "def": cid
                }
            ]
        });
        editor.on('initEdit', function () {
            editor.disable('cliente_id');
        });
        editor.on('initCreate', function () {
            editor.disable('cliente_id');
        });
        $('#kqi').on( 'click', 'tbody td.editable', function (e) {
            editor.inline( this );
        } );

        var table = $('#kqi').DataTable({
            dom: 'Bfrtip',
            ajax: {
                url: 'php/table.kqi.php',
                type: "POST",
                data: function (d) {
                    d.ci = cid;
                }
            },
            columns: [
                {
                    "data": "data",
                    "render": function(data, type, full) {
                        return (data) ? moment(data).format('DD MMM YYYY  HH:mm:ss') : '';
                    },
                    className: 'editable acenter'
                },
                {
                    "data": "cliente_id",
                    className: "acenter"
                },
                {
                    "data": "prepagato", render: $.fn.dataTable.render.number('.', ',', 2, '€ '),
                    className: 'editable aright'
                },
                {
                    "data": "costo_totale", render: $.fn.dataTable.render.number('.', ',', 2, '€ '),
                    className: 'editable aright'
                }
            ],
            "columnDefs": [
              //  {className: "aright", "targets": [2, 3]},
                //{className: "acenter", "targets": [0,1]}
                // {"orderable": false, "targets": [1, 2, 3, 4]}
            ],
            select: 'single',
            serverSide: true,
            lengthChange: true,
            order: [[0, "desc"]],
            language: {
                "decimal": ",",
                "thousands": ".",
                "url": "dataTables.italian.lang",
                select: {
                    rows: {
                        _: "%d righe selezionate",
                        0:'',
                        1: "<i>1 riga selezionata</i>"
                    }
                }
            },
            buttons: [
                {extend: 'create', editor: editor},
                {extend: 'edit', editor: editor},
                {extend: 'remove', editor: editor}
                /*{
                    extend: "create",
                    text: "Apri Totali",
                    action: function (e, dt, node, config) {
                        window.open("report2.php", "_blank")
                    }
                }*/
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                $.ajax({
                    url: "totale.php?id="+cid,
                    success: function (data, stato) {
                        $(api.column(3).footer()).html(data);
                    },
                    error: function (richiesta, stato, errori) {}
                })
            }
        });
    });

}(jQuery));

