$(document).ready(function(){
  $('.status').each(function(){
    $(this).html(emojis($(this).text()));
  });
});

function emojis(value) {
  var emojis = [
    {codigo:':3',class:'emoji lengua'},
    {codigo:'xD',class:'emoji XD'},
    {codigo:':)',class:'emoji smile'},
    {codigo:';)',class:'emoji coqueteo'},     
  ];

  var result = findById(emojis, 45);

  for (i = 0; i < emojis.length; i++){
    var emoji = emojis[i];
    var image = '<span class="' + emoji.class + '"></span>';
    value = replaceAll(value, emoji.codigo,image);
    value = value.replace(emoji.codigo,image);
  }
  return value;
}

function findById(source, id) {
    return source.filter(function( obj ) {
        // coerce both obj.id and id to numbers 
        // for val & type comparison
        return +obj.id === +id;
    })[ 0 ];
}


function replaceAll(str, find, replace) {  
  try{
    return str.replace(new RegExp(find, 'g'), replace);
  }catch(ex){
    return str;
  }
}


