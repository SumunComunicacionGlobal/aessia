 

/*

<div class="btn-double js-btn-double">
  <div class="btn-double__wrap">
    <a 
    	class="btn-double__main-action wp-block-button__link btn btn-outline-primary js-btn-double-default" 
    	href="https://www.pegasso.org/pegasso/inicio.public">Acceso a Pegasso</a>
    <div class="btn-double__more js-btn-double-more">+</div>
  </div>
  <div class="btn-double__options js-btn-double-options">
    <a class="btn-double__options__option js-btn-double-rite js-btn-double-option" 
       data-pegasso-option="btrite" 
       data-pegasso-button-text="Baja tensión + RITE"  
       href="https://www.pegasso.org/pegasso/inicio.public">
      <strong>Acceso a Pegasso Baja Tensión + RITE</strong>
      <p>Descripción de Pegasso Baja Tensión + RITE en dos líneas</p>
    </a>
    <a class="btn-double__options__option js-btn-double-incendios js-btn-double-option" 
       data-pegasso-option="incendios"
       data-pegasso-button-text="Incendios"
       href="https://www.pegasso.org/">
      <strong>Acceso a Pegasso Incendios</strong>
      <p>Descripción de Pegasso Incendios en dos líneas</p>
    </a>
  </div>
</div>

*/





function fnAessiaButtonDouble(  ) {

	fnAessiaButtonDoubleToggleMore(  );
	fnAessiaButtonDoubleClickListeners(  );
	fnAessiaButtonDoubleSetDefaultLink(  );

}
fnAessiaButtonDouble(  );





function fnAessiaButtonDoubleToggleMore(  ) {

	document.querySelectorAll( '.js-btn-double-more' )[0]
		.addEventListener( 
			'click', 
			function( event ) {
				event.preventDefault(  );
				document.querySelectorAll( '.js-btn-double' )[0]
					.classList.toggle( "is-active" );
	});
}





function fnAessiaButtonDoubleClickListeners(  ) {

	document.querySelectorAll( '.js-btn-double-option' ).forEach( function( oOption ) {

		oOption.addEventListener( 'click', function( event ) {
			event.preventDefault(  );
			fnAessiaButtonDoubleSetCookie( this.getAttribute( 'data-pegasso-option' ) );
			location.assign( this.getAttribute( 'href' ) );
		});

	});

}





function fnAessiaButtonDoubleSetCookie( sDefaultPegasso ) {
  var oDate = new Date(  );
	oDate.setTime( oDate.getTime(  ) + 3600 * 1000 * 24 * 365 * 2 ); // 2 years
  document.cookie = 'pegasso_double_button_default=' + sDefaultPegasso + '; expires=' + oDate.toGMTString(  ) + '; path=/; domain=aessia.org;';
	return;
}





function fnAessiaButtonDoubleSetDefaultLink(  ) {
	var sCookiePegasso = document.cookie.match( '(^|;)\\s*pegasso_double_button_default\\s*=\\s*([^;]+)')?.pop(  ) || '';
	if( sCookiePegasso == '' ) {
		return;
	}

	var sCssSelectorOption = '.js-btn-double-option[data-pegasso-option="' + sCookiePegasso + '"]';
	var oOptionLink = document.querySelectorAll( sCssSelectorOption )[0];

	var sLinkUrl = oOptionLink.getAttribute( 'href' );
	var sButtonSmallText = oOptionLink.getAttribute( 'data-pegasso-button-text' );

	var oDefaultButton = document.querySelectorAll( '.js-btn-double-default' )[0];
	oDefaultButton.setAttribute( 'href' , sLinkUrl );
	oDefaultButton.innerHTML = '<strong>Acceso a Pegasso</strong><small>' + sButtonSmallText + '</small>';
	oDefaultButton.classList.add( 'btn-with-description' );

	return;
}



















