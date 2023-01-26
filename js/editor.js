wp.domReady( () => {
  
  wp.blocks.registerBlockStyle( 'core/button', {
    
    name: 'arrow-link',
    label: 'Enlace con flecha',

  } );

  wp.blocks.registerBlockStyle( 'core/cover', {
    
    name: 'imagen-cabecera',
    label: 'Imagen de cabecera',

  } );

  wp.blocks.registerBlockStyle( 'core/cover', {
    
    name: 'superpuesto',
    label: 'Contenido superpuesto arriba izquierda',

  } );

  wp.blocks.registerBlockStyle( 'core/cover', {
    
    name: 'apilado',
    label: 'Imagen y contenido apilados',

  } );

} );