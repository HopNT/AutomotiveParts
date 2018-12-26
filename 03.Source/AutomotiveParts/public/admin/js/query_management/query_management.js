$(document).ready(function () {

    $('body').on('click','#btn_run', function () {
        $('.table-result').html('');
        $('#message').text('');
        $('#error').text('');
        var url = $('#frmRunSQL').attr('action');
        $.ajax({
            type:'POST',
            url:url,
            data: {
                query : ($('#query').val()).replace(/(?:\r\n|\r|\n)/g,'')
            },
        success:function(rs){
                if(rs.error){
                    $('#error').text(rs.error);
                }else if(rs.data){
                    $('.table-result').createTable(rs.data, {
                        // General Style for Table
                        borderWidth: '1px',
                        borderStyle: 'solid',
                        borderColor: '#DDDDDD',
                        fontFamily: 'Roboto,sans-serif',

                        // Table Header Style
                        thBg: '#F3F3F3',
                        thColor: '#0E0E0E',
                        thHeight: '30px',
                        thFontFamily: '"Roboto,sans-serif',
                        thFontSize: '14px',
                        thTextTransform: 'capitalize',

                        // Table Body/Row Style
                        trBg: '#fff',
                        trColor: '#0E0E0E',
                        trHeight: '25px',
                        trFontFamily: '"Roboto,sans-serif',
                        trFontSize: '13px',

                        // Table Body's Column Style
                        tdPaddingLeft: '10px',
                        tdPaddingRight: '10px'
                    });
                }else if(rs.mes){
                    $('#message').text(rs.mes);
                }
            }
        });
    });
});
