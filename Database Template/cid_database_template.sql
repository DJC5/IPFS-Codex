PGDMP                      |           cid_database    16.3    16.3     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16406    cid_database    DATABASE     �   CREATE DATABASE cid_database WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
    DROP DATABASE cid_database;
                postgres    false            �            1259    16407    item_profile    TABLE     �  CREATE TABLE public.item_profile (
    filename text NOT NULL,
    ext text NOT NULL,
    cid text NOT NULL,
    description text,
    link text,
    creation_date date DEFAULT now() NOT NULL,
    type text,
    CONSTRAINT cid_length_46 CHECK ((char_length(cid) = 46)),
    CONSTRAINT date_length_10 CHECK ((char_length(((creation_date)::character varying)::text) = 10)),
    CONSTRAINT description_length_2000 CHECK ((char_length(description) <= 2000)),
    CONSTRAINT ext_length_10 CHECK ((char_length(ext) <= 10)),
    CONSTRAINT filename_length_100 CHECK ((char_length(filename) <= 100)),
    CONSTRAINT link_length_500 CHECK ((char_length(link) <= 500)),
    CONSTRAINT type_length_20 CHECK ((char_length(type) < 20))
);
     DROP TABLE public.item_profile;
       public         heap    phpdb    false            �          0    16407    item_profile 
   TABLE DATA           b   COPY public.item_profile (filename, ext, cid, description, link, creation_date, type) FROM stdin;
    public          phpdb    false    215   q
       #           2606    16429 !   item_profile Name Date Difference 
   CONSTRAINT     q   ALTER TABLE ONLY public.item_profile
    ADD CONSTRAINT "Name Date Difference" UNIQUE (filename, creation_date);
 M   ALTER TABLE ONLY public.item_profile DROP CONSTRAINT "Name Date Difference";
       public            phpdb    false    215    215            %           2606    16421    item_profile item_profile_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.item_profile
    ADD CONSTRAINT item_profile_pkey PRIMARY KEY (cid);
 H   ALTER TABLE ONLY public.item_profile DROP CONSTRAINT item_profile_pkey;
       public            phpdb    false    215            �   K  x���N�@���S�@A��]���.*�xA���RCgNm��K/V�6qk·��|�g�9@KAp��/ ]/k��� ���a�s!��+à���`����Fw�In�H�X�M�6��	+��1L�c+z� �Pr3 _<�IO|�sZ��S1�$����˜5c���K�C[ZZZZZZ�=���mт��Lدm�8��&@P΅�X�(y	N��$l*B� P�)(U���,�!c�yD�մV����p�/@�ձm�g���G	�,x�c`R�b���f�dn�B/\���{^׈B�|ၛxQP�{�GW�(H��<���Ut�l�IO�$I�ά�     