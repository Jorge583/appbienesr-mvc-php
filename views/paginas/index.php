<main class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>
        <?php include 'iconos.php';?>  
    </main>
    <section class="seccion contenedor">
        <h2>Casas y Apartamentos en ventas</h2>

        <?php 
        //$limite = 3;
            include'listado.php';
        ?>  
        <div class="alinear-derecha">
            <a href="/propiedades" class="boton-verde">Ver Todas</a>
        </div>
    </section>
    <section class="imagen-contacto">
        <h2>Encuentra La Casa DeTu Sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pomdra en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    </section>
    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="texto entrada blog">
                    </picture>
                </div>
                    <div class="texto-entrada">
                        <a href="entrada.html"> 
                            <h4>terrazas en el techo de tu casa</h4>
                            <p class="informacion-meta">escrito el: <span>21/10/2024</span>por:<span>ADMIN</span></p>

                            <p>consejos para contruir una terraza en el techode tu casa con los mejores materiales ahorrandodinero</p>
                       </a>
                    </div>
                
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="texto entrada blog">
                    </picture>
                </div>
                    <div class="texto-entrada">
                        <a href="entrada.html">
                            <h4>guia de decoracion de tru hogar</h4>
                            <p class="informacion-meta">escrito el: <span>21/10/2024</span>por: <span>ADMIN</span></p>
                            
                            <p>maximisa el espacio de tu hogar con esta guia , aprender a convinar muebles y colores para darle vida a tu espacio</p>
                        </a>
                    </div>
               
            </article>
        </section>
        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    el personal se comporto de una exelente forma, muy buena atencion y la casa que me ofrecieron cumple con jks expectativas
                </blockquote>
                <p>jorge luis teran </p>
                
            </div>
        </section>
    </div>  
