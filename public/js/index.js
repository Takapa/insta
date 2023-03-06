
function SelectPage( page ) {
  var elementPage1 = document.getElementById( "page1" );
  var elementPage2 = document.getElementById( "page2" );
  var elementPage3 = document.getElementById( "page3" );

  switch( page ) {
  case 1:
      elementPage1.style.display = 'block';
      elementPage2.style.display = 'none';
      elementPage3.style.display = 'none';
      break;

  case 2:
      elementPage1.style.display = 'none';
      elementPage2.style.display = 'block';
      elementPage3.style.display = 'none';
      break;

  case 3:
      elementPage1.style.display = 'none';
      elementPage2.style.display = 'none';
      elementPage3.style.display = 'block';
      break;
  }

}
