PGDMP         6                y         
   youngblood    13.3    13.3 K               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    17783 
   youngblood    DATABASE     l   CREATE DATABASE youngblood WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_El Salvador.1252';
    DROP DATABASE youngblood;
                postgres    false            ?            1259    17784 
   categorias    TABLE     ?   CREATE TABLE public.categorias (
    id_categoria integer NOT NULL,
    nombre_categoria character varying(50) NOT NULL,
    descripcion_categoria character varying(250),
    imagen_categoria character varying(50) NOT NULL
);
    DROP TABLE public.categorias;
       public         heap    postgres    false            ?            1259    17787    categorias_id_categoria_seq    SEQUENCE     ?   CREATE SEQUENCE public.categorias_id_categoria_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.categorias_id_categoria_seq;
       public          postgres    false    200                       0    0    categorias_id_categoria_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.categorias_id_categoria_seq OWNED BY public.categorias.id_categoria;
          public          postgres    false    201            ?            1259    17789    clientes    TABLE       CREATE TABLE public.clientes (
    id_cliente integer NOT NULL,
    nombres_cliente character varying(50) NOT NULL,
    apellidos_cliente character varying(50) NOT NULL,
    dui_cliente character varying(10) NOT NULL,
    correo_cliente character varying(100) NOT NULL,
    telefono_cliente character varying(9) NOT NULL,
    nacimiento_cliente date NOT NULL,
    clave_cliente character varying(100) NOT NULL,
    estado_cliente boolean DEFAULT true NOT NULL,
    direccion_cliente character varying(200) NOT NULL,
    fecha_registro date
);
    DROP TABLE public.clientes;
       public         heap    postgres    false            ?            1259    17796    clientes_id_cliente_seq    SEQUENCE     ?   CREATE SEQUENCE public.clientes_id_cliente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.clientes_id_cliente_seq;
       public          postgres    false    202                       0    0    clientes_id_cliente_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.clientes_id_cliente_seq OWNED BY public.clientes.id_cliente;
          public          postgres    false    203            ?            1259    17798    detalle_pedido    TABLE     ?   CREATE TABLE public.detalle_pedido (
    id_detalle integer NOT NULL,
    id_producto integer NOT NULL,
    cantidad_producto smallint NOT NULL,
    precio numeric(5,2) NOT NULL,
    id_pedido integer NOT NULL
);
 "   DROP TABLE public.detalle_pedido;
       public         heap    postgres    false            ?            1259    17801    detalle_pedidos_id_detalle_seq    SEQUENCE     ?   CREATE SEQUENCE public.detalle_pedidos_id_detalle_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.detalle_pedidos_id_detalle_seq;
       public          postgres    false    204                       0    0    detalle_pedidos_id_detalle_seq    SEQUENCE OWNED BY     `   ALTER SEQUENCE public.detalle_pedidos_id_detalle_seq OWNED BY public.detalle_pedido.id_detalle;
          public          postgres    false    205            ?            1259    17803    pedidos    TABLE     ?   CREATE TABLE public.pedidos (
    id_pedido integer NOT NULL,
    id_cliente integer NOT NULL,
    estado_pedido smallint DEFAULT 0 NOT NULL,
    fecha_pedido date
);
    DROP TABLE public.pedidos;
       public         heap    postgres    false            ?            1259    17807    pedidos_id_pedido_seq    SEQUENCE     ?   CREATE SEQUENCE public.pedidos_id_pedido_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.pedidos_id_pedido_seq;
       public          postgres    false    206                       0    0    pedidos_id_pedido_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.pedidos_id_pedido_seq OWNED BY public.pedidos.id_pedido;
          public          postgres    false    207            ?            1259    17809 	   productos    TABLE     ?  CREATE TABLE public.productos (
    id_producto integer NOT NULL,
    nombre_producto character varying(50) NOT NULL,
    descripcion_producto character varying(250) NOT NULL,
    precio_producto numeric(5,2) NOT NULL,
    imagen_producto character varying(50) NOT NULL,
    id_categoria integer NOT NULL,
    estado_producto boolean NOT NULL,
    id_usuario integer NOT NULL,
    cantidad numeric
);
    DROP TABLE public.productos;
       public         heap    postgres    false            ?            1259    17815    productos_id_producto_seq    SEQUENCE     ?   CREATE SEQUENCE public.productos_id_producto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.productos_id_producto_seq;
       public          postgres    false    208                       0    0    productos_id_producto_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.productos_id_producto_seq OWNED BY public.productos.id_producto;
          public          postgres    false    209            ?            1259    17817    puntuaciones    TABLE     x   CREATE TABLE public.puntuaciones (
    id_puntuacion integer NOT NULL,
    puntuacion character varying(15) NOT NULL
);
     DROP TABLE public.puntuaciones;
       public         heap    postgres    false            ?            1259    17820    puntuaciones_id_puntuacion_seq    SEQUENCE     ?   CREATE SEQUENCE public.puntuaciones_id_puntuacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.puntuaciones_id_puntuacion_seq;
       public          postgres    false    210                       0    0    puntuaciones_id_puntuacion_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.puntuaciones_id_puntuacion_seq OWNED BY public.puntuaciones.id_puntuacion;
          public          postgres    false    211            ?            1259    17822    usuarios    TABLE     E  CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    nombres_usuario character varying(50) NOT NULL,
    apellidos_usuario character varying(50) NOT NULL,
    correo_usuario character varying(100) NOT NULL,
    alias_usuario character varying(50) NOT NULL,
    clave_usuario character varying(100) NOT NULL
);
    DROP TABLE public.usuarios;
       public         heap    postgres    false            ?            1259    17825    usuarios_id_usuario_seq    SEQUENCE     ?   CREATE SEQUENCE public.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.usuarios_id_usuario_seq;
       public          postgres    false    212                       0    0    usuarios_id_usuario_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;
          public          postgres    false    213            ?            1259    17827    valoraciones    TABLE       CREATE TABLE public.valoraciones (
    id_valoracion integer NOT NULL,
    id_cliente integer NOT NULL,
    valoracion character varying(200) NOT NULL,
    fecha date NOT NULL,
    id_puntuacion integer NOT NULL,
    id_producto integer NOT NULL,
    visibilidad integer
);
     DROP TABLE public.valoraciones;
       public         heap    postgres    false            ?            1259    17830    valoraciones_id_valoracion_seq    SEQUENCE     ?   CREATE SEQUENCE public.valoraciones_id_valoracion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.valoraciones_id_valoracion_seq;
       public          postgres    false    214                       0    0    valoraciones_id_valoracion_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.valoraciones_id_valoracion_seq OWNED BY public.valoraciones.id_valoracion;
          public          postgres    false    215            N           2604    17832    categorias id_categoria    DEFAULT     ?   ALTER TABLE ONLY public.categorias ALTER COLUMN id_categoria SET DEFAULT nextval('public.categorias_id_categoria_seq'::regclass);
 F   ALTER TABLE public.categorias ALTER COLUMN id_categoria DROP DEFAULT;
       public          postgres    false    201    200            P           2604    17833    clientes id_cliente    DEFAULT     z   ALTER TABLE ONLY public.clientes ALTER COLUMN id_cliente SET DEFAULT nextval('public.clientes_id_cliente_seq'::regclass);
 B   ALTER TABLE public.clientes ALTER COLUMN id_cliente DROP DEFAULT;
       public          postgres    false    203    202            Q           2604    17834    detalle_pedido id_detalle    DEFAULT     ?   ALTER TABLE ONLY public.detalle_pedido ALTER COLUMN id_detalle SET DEFAULT nextval('public.detalle_pedidos_id_detalle_seq'::regclass);
 H   ALTER TABLE public.detalle_pedido ALTER COLUMN id_detalle DROP DEFAULT;
       public          postgres    false    205    204            S           2604    17835    pedidos id_pedido    DEFAULT     v   ALTER TABLE ONLY public.pedidos ALTER COLUMN id_pedido SET DEFAULT nextval('public.pedidos_id_pedido_seq'::regclass);
 @   ALTER TABLE public.pedidos ALTER COLUMN id_pedido DROP DEFAULT;
       public          postgres    false    207    206            T           2604    17836    productos id_producto    DEFAULT     ~   ALTER TABLE ONLY public.productos ALTER COLUMN id_producto SET DEFAULT nextval('public.productos_id_producto_seq'::regclass);
 D   ALTER TABLE public.productos ALTER COLUMN id_producto DROP DEFAULT;
       public          postgres    false    209    208            U           2604    17837    puntuaciones id_puntuacion    DEFAULT     ?   ALTER TABLE ONLY public.puntuaciones ALTER COLUMN id_puntuacion SET DEFAULT nextval('public.puntuaciones_id_puntuacion_seq'::regclass);
 I   ALTER TABLE public.puntuaciones ALTER COLUMN id_puntuacion DROP DEFAULT;
       public          postgres    false    211    210            V           2604    17838    usuarios id_usuario    DEFAULT     z   ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);
 B   ALTER TABLE public.usuarios ALTER COLUMN id_usuario DROP DEFAULT;
       public          postgres    false    213    212            W           2604    17839    valoraciones id_valoracion    DEFAULT     ?   ALTER TABLE ONLY public.valoraciones ALTER COLUMN id_valoracion SET DEFAULT nextval('public.valoraciones_id_valoracion_seq'::regclass);
 I   ALTER TABLE public.valoraciones ALTER COLUMN id_valoracion DROP DEFAULT;
       public          postgres    false    215    214            ?          0    17784 
   categorias 
   TABLE DATA           m   COPY public.categorias (id_categoria, nombre_categoria, descripcion_categoria, imagen_categoria) FROM stdin;
    public          postgres    false    200   ?_                 0    17789    clientes 
   TABLE DATA           ?   COPY public.clientes (id_cliente, nombres_cliente, apellidos_cliente, dui_cliente, correo_cliente, telefono_cliente, nacimiento_cliente, clave_cliente, estado_cliente, direccion_cliente, fecha_registro) FROM stdin;
    public          postgres    false    202   .`                 0    17798    detalle_pedido 
   TABLE DATA           g   COPY public.detalle_pedido (id_detalle, id_producto, cantidad_producto, precio, id_pedido) FROM stdin;
    public          postgres    false    204   ?b                 0    17803    pedidos 
   TABLE DATA           U   COPY public.pedidos (id_pedido, id_cliente, estado_pedido, fecha_pedido) FROM stdin;
    public          postgres    false    206   (c                 0    17809 	   productos 
   TABLE DATA           ?   COPY public.productos (id_producto, nombre_producto, descripcion_producto, precio_producto, imagen_producto, id_categoria, estado_producto, id_usuario, cantidad) FROM stdin;
    public          postgres    false    208   rc       	          0    17817    puntuaciones 
   TABLE DATA           A   COPY public.puntuaciones (id_puntuacion, puntuacion) FROM stdin;
    public          postgres    false    210   Ie                 0    17822    usuarios 
   TABLE DATA           ?   COPY public.usuarios (id_usuario, nombres_usuario, apellidos_usuario, correo_usuario, alias_usuario, clave_usuario) FROM stdin;
    public          postgres    false    212   ~e                 0    17827    valoraciones 
   TABLE DATA           }   COPY public.valoraciones (id_valoracion, id_cliente, valoracion, fecha, id_puntuacion, id_producto, visibilidad) FROM stdin;
    public          postgres    false    214   ?e                  0    0    categorias_id_categoria_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.categorias_id_categoria_seq', 3, true);
          public          postgres    false    201                       0    0    clientes_id_cliente_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.clientes_id_cliente_seq', 8, true);
          public          postgres    false    203                       0    0    detalle_pedidos_id_detalle_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.detalle_pedidos_id_detalle_seq', 25, true);
          public          postgres    false    205                        0    0    pedidos_id_pedido_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.pedidos_id_pedido_seq', 7, true);
          public          postgres    false    207            !           0    0    productos_id_producto_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.productos_id_producto_seq', 10, true);
          public          postgres    false    209            "           0    0    puntuaciones_id_puntuacion_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.puntuaciones_id_puntuacion_seq', 5, true);
          public          postgres    false    211            #           0    0    usuarios_id_usuario_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 1, true);
          public          postgres    false    213            $           0    0    valoraciones_id_valoracion_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.valoraciones_id_valoracion_seq', 13, true);
          public          postgres    false    215            Y           2606    17841 *   categorias categorias_nombre_categoria_key 
   CONSTRAINT     q   ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_nombre_categoria_key UNIQUE (nombre_categoria);
 T   ALTER TABLE ONLY public.categorias DROP CONSTRAINT categorias_nombre_categoria_key;
       public            postgres    false    200            [           2606    17843    categorias categorias_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (id_categoria);
 D   ALTER TABLE ONLY public.categorias DROP CONSTRAINT categorias_pkey;
       public            postgres    false    200            ^           2606    17845 $   clientes clientes_correo_cliente_key 
   CONSTRAINT     i   ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_correo_cliente_key UNIQUE (correo_cliente);
 N   ALTER TABLE ONLY public.clientes DROP CONSTRAINT clientes_correo_cliente_key;
       public            postgres    false    202            `           2606    17847 !   clientes clientes_dui_cliente_key 
   CONSTRAINT     c   ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_dui_cliente_key UNIQUE (dui_cliente);
 K   ALTER TABLE ONLY public.clientes DROP CONSTRAINT clientes_dui_cliente_key;
       public            postgres    false    202            b           2606    17849    clientes clientes_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id_cliente);
 @   ALTER TABLE ONLY public.clientes DROP CONSTRAINT clientes_pkey;
       public            postgres    false    202            d           2606    17851 "   detalle_pedido detalle_pedido_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT detalle_pedido_pkey PRIMARY KEY (id_detalle);
 L   ALTER TABLE ONLY public.detalle_pedido DROP CONSTRAINT detalle_pedido_pkey;
       public            postgres    false    204            f           2606    17853    pedidos pedidos_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT pedidos_pkey PRIMARY KEY (id_pedido);
 >   ALTER TABLE ONLY public.pedidos DROP CONSTRAINT pedidos_pkey;
       public            postgres    false    206            h           2606    17855 '   productos productos_nombre_producto_key 
   CONSTRAINT     m   ALTER TABLE ONLY public.productos
    ADD CONSTRAINT productos_nombre_producto_key UNIQUE (nombre_producto);
 Q   ALTER TABLE ONLY public.productos DROP CONSTRAINT productos_nombre_producto_key;
       public            postgres    false    208            j           2606    17857    productos productos_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.productos
    ADD CONSTRAINT productos_pkey PRIMARY KEY (id_producto);
 B   ALTER TABLE ONLY public.productos DROP CONSTRAINT productos_pkey;
       public            postgres    false    208            l           2606    17859    puntuaciones puntuaciones_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY public.puntuaciones
    ADD CONSTRAINT puntuaciones_pkey PRIMARY KEY (id_puntuacion);
 H   ALTER TABLE ONLY public.puntuaciones DROP CONSTRAINT puntuaciones_pkey;
       public            postgres    false    210            n           2606    17861 #   usuarios usuarios_alias_usuario_key 
   CONSTRAINT     g   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_alias_usuario_key UNIQUE (alias_usuario);
 M   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_alias_usuario_key;
       public            postgres    false    212            p           2606    17863 $   usuarios usuarios_correo_usuario_key 
   CONSTRAINT     i   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_usuario_key UNIQUE (correo_usuario);
 N   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_correo_usuario_key;
       public            postgres    false    212            r           2606    17865    usuarios usuarios_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public            postgres    false    212            t           2606    17867    valoraciones valoraciones_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY public.valoraciones
    ADD CONSTRAINT valoraciones_pkey PRIMARY KEY (id_valoracion);
 H   ALTER TABLE ONLY public.valoraciones DROP CONSTRAINT valoraciones_pkey;
       public            postgres    false    214            \           1259    17868    nombre_index    INDEX     V   CREATE UNIQUE INDEX nombre_index ON public.categorias USING btree (nombre_categoria);
     DROP INDEX public.nombre_index;
       public            postgres    false    200            u           2606    17869 ,   detalle_pedido detalle_pedido_id_pedido_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT detalle_pedido_id_pedido_fkey FOREIGN KEY (id_pedido) REFERENCES public.pedidos(id_pedido) NOT VALID;
 V   ALTER TABLE ONLY public.detalle_pedido DROP CONSTRAINT detalle_pedido_id_pedido_fkey;
       public          postgres    false    204    2918    206            v           2606    17874 .   detalle_pedido detalle_pedido_id_producto_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT detalle_pedido_id_producto_fkey FOREIGN KEY (id_producto) REFERENCES public.productos(id_producto);
 X   ALTER TABLE ONLY public.detalle_pedido DROP CONSTRAINT detalle_pedido_id_producto_fkey;
       public          postgres    false    208    204    2922            x           2606    17879    productos id_categoria    FK CONSTRAINT     ?   ALTER TABLE ONLY public.productos
    ADD CONSTRAINT id_categoria FOREIGN KEY (id_categoria) REFERENCES public.categorias(id_categoria) NOT VALID;
 @   ALTER TABLE ONLY public.productos DROP CONSTRAINT id_categoria;
       public          postgres    false    2907    200    208            y           2606    17884    productos id_usuario    FK CONSTRAINT     ?   ALTER TABLE ONLY public.productos
    ADD CONSTRAINT id_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id_usuario) NOT VALID;
 >   ALTER TABLE ONLY public.productos DROP CONSTRAINT id_usuario;
       public          postgres    false    212    208    2930            w           2606    17889    pedidos pedidos_id_cliente_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT pedidos_id_cliente_fkey FOREIGN KEY (id_cliente) REFERENCES public.clientes(id_cliente);
 I   ALTER TABLE ONLY public.pedidos DROP CONSTRAINT pedidos_id_cliente_fkey;
       public          postgres    false    2914    202    206            z           2606    17894 )   valoraciones valoraciones_id_cliente_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.valoraciones
    ADD CONSTRAINT valoraciones_id_cliente_fkey FOREIGN KEY (id_cliente) REFERENCES public.clientes(id_cliente);
 S   ALTER TABLE ONLY public.valoraciones DROP CONSTRAINT valoraciones_id_cliente_fkey;
       public          postgres    false    202    2914    214            {           2606    17899 *   valoraciones valoraciones_id_producto_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.valoraciones
    ADD CONSTRAINT valoraciones_id_producto_fkey FOREIGN KEY (id_producto) REFERENCES public.productos(id_producto);
 T   ALTER TABLE ONLY public.valoraciones DROP CONSTRAINT valoraciones_id_producto_fkey;
       public          postgres    false    2922    208    214            |           2606    17904 ,   valoraciones valoraciones_id_puntuacion_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.valoraciones
    ADD CONSTRAINT valoraciones_id_puntuacion_fkey FOREIGN KEY (id_puntuacion) REFERENCES public.puntuaciones(id_puntuacion);
 V   ALTER TABLE ONLY public.valoraciones DROP CONSTRAINT valoraciones_id_puntuacion_fkey;
       public          postgres    false    214    210    2924            ?   ?   x?-?;? ?N?'@?DV?s?H??4?b$?" 9?E5???L???,???gK??#?/?g?X?epmd??Ъ?r+&??%???g8? yۢCڴu?^.8??ιv???yش??v
v?F??v??[I)???7?         ?  x?u??r?0 е?,??H??+?	?cיnD6H? ?????+<?v?v܁3WW:x"??Q??^ª??6??^!?m??4S?yLòeZ&?b??a<?????K????u???
???M??&Q?z?*YE??w??|W??Ͼ???Q??Brr??3R?_?H???cRe??bA	?8???^?%?RV?[?i???[?^?cM6MmĪ5k7?????(?N??9h????9)??xa???????'_??7g?٢:^?+6??a1R_?E?*?O?$?OEF-B?6j???k?a?@?m??߬?????C?w???x??A_?WOh	?ay|???c??F??@5?u???ډ:??0??E??V?INk׀_2*?I?ɻJ1?5????' ?????4?B%?w?h???֓횆h??R???E?hO-&b??>??\[??QE?Ԯ??j???B?H$R????TpiB?c]&B????ԽҲ????G?F}3?<ߜ??"?W???J????AqR???<??d?@?h?\?UnxŶQ?y|?S?PQQJ}.???:e1g$??<??ܵ?;??7??:?5N???ϰ4?lw?O=G?????$E?z???s??љ|>.?T#&?L?ZI?R???h6?J????%?         V   x?E???0Cѳ=L??d???G?I?㓿@*XMu???D?ԙ??1??>uZ?Pؑ"r????o??^7S??????.?F???         :   x?Uȱ  ???Ã?ø?Z??W^H?7?Z*u??jD????c?I{???@         ?  x?m??n?0???)? ???`?m׍?????????Ȇ????6?u?10g??\?X`???I??f? ??<A?n:?hl	A=1Djve?]?bhEѮ????و???&????g????!u??7ڷ?$E	??????K?=mnՠ???q(?K=?K^???j?~?8Zl6??[?d_]?E1?h?O?????K2????Jc?W???+???&2鵄ɇ, ???`??8?rD???pe]W#v5???s?aJ??????qі?]?kݏ???n?4????_??ȕi??I̖ƇyW??? A	fN@(m?
??>Ή???&_m?	????????ϵ1??rd?"]u?[+?Q?#?R??????``t4??'????M.?????C?/TѢ??!>?N??TB??{??Z;??[s?\??u??Ln??M<6??U?S2t0Ю?J?5? ??m??/x      	   %   x?3?|4???D??P?m?`???(\?H? "G?         i   x?3?tJ?,??㬪??L3?s3s???s??%U?*F?*?*ƕ9???y?U???z????????NY&U??N???9?n~?>.fzf?F??yU>?\1z\\\ ?G"(         }   x?U?1?0Eg??@??6@W???%J-???&?8>?R??????#????????.???}]55?--5?d?j4??:ps????1???;u?4?Kk?룮~??z:????o8 ?O????*m     