PGDMP      :                |           cid_database    15.6 (Debian 15.6-0+deb12u1)    16.3     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16388    cid_database    DATABASE     x   CREATE DATABASE cid_database WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.UTF-8';
    DROP DATABASE cid_database;
                postgres    false            �           0    0    DATABASE cid_database    ACL     1   GRANT CONNECT ON DATABASE cid_database TO phpdb;
                   postgres    false    4004            �            1259    16389    item_profile    TABLE     �  CREATE TABLE public.item_profile (
    filename text NOT NULL,
    ext text NOT NULL,
    cid text NOT NULL,
    description text,
    link text,
    creation_date date DEFAULT now() NOT NULL,
    CONSTRAINT cid_length_46 CHECK ((char_length(cid) = 46)),
    CONSTRAINT date_length_10 CHECK ((char_length(((creation_date)::character varying)::text) = 10)),
    CONSTRAINT description_length_2000 CHECK ((char_length(description) <= 2000)),
    CONSTRAINT ext_length_10 CHECK ((char_length(ext) <= 10)),
    CONSTRAINT filename_length_100 CHECK ((char_length(filename) <= 100)),
    CONSTRAINT link_length_500 CHECK ((char_length(link) <= 500))
);
     DROP TABLE public.item_profile;
       public         heap    postgres    false            �           0    0    TABLE item_profile    ACL     ;   GRANT SELECT,INSERT ON TABLE public.item_profile TO phpdb;
          public          postgres    false    214            �          0    16389    item_profile 
   TABLE DATA           \   COPY public.item_profile (filename, ext, cid, description, link, creation_date) FROM stdin;
    public          postgres    false    214   �                  2606    16402 !   item_profile Name Date Difference 
   CONSTRAINT     q   ALTER TABLE ONLY public.item_profile
    ADD CONSTRAINT "Name Date Difference" UNIQUE (filename, creation_date);
 M   ALTER TABLE ONLY public.item_profile DROP CONSTRAINT "Name Date Difference";
       public            postgres    false    214    214                       2606    16404    item_profile item_profile_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.item_profile
    ADD CONSTRAINT item_profile_pkey PRIMARY KEY (cid);
 H   ALTER TABLE ONLY public.item_profile DROP CONSTRAINT item_profile_pkey;
       public            postgres    false    214            �           826    16406    DEFAULT PRIVILEGES FOR TABLES    DEFAULT ACL     S   ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT SELECT,INSERT ON TABLES TO phpdb;
                   postgres    false            �   �   x��Q
�  �g=�P��A�kE��6���,)��WV�>����4�Dg\������PHd��Ɲ��p�v�m휗ջ���a�.��Q�a��Wvc�Kt���H�� �O$�d��AԿ"�C�\H�*V��0�?|*�     