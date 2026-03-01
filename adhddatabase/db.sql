--
-- PostgreSQL database dump
--

\restrict pDuaiOLOCaMKV8vR09VMyoxwonDWhR26mbzOB2p1wcQ5oKvIDGDlvVYMawtH2yi

-- Dumped from database version 17.6
-- Dumped by pg_dump version 17.6

-- Started on 2026-03-01 00:10:59

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 6 (class 2615 OID 41320)
-- Name: auth; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA auth;


ALTER SCHEMA auth OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 221 (class 1259 OID 41367)
-- Name: api; Type: TABLE; Schema: auth; Owner: postgres
--

CREATE TABLE auth.api (
    uuid uuid DEFAULT gen_random_uuid() NOT NULL,
    bcrypt text NOT NULL
);


ALTER TABLE auth.api OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 41341)
-- Name: session; Type: TABLE; Schema: auth; Owner: postgres
--

CREATE TABLE auth.session (
    uuid uuid DEFAULT gen_random_uuid() NOT NULL,
    user_uuid uuid NOT NULL,
    start timestamp without time zone NOT NULL,
    heartbeat timestamp without time zone,
    valid boolean DEFAULT true NOT NULL,
    ip inet NOT NULL
);


ALTER TABLE auth.session OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 41321)
-- Name: user; Type: TABLE; Schema: auth; Owner: postgres
--

CREATE TABLE auth."user" (
    username text NOT NULL,
    bcrypt text NOT NULL,
    user_uuid uuid NOT NULL
);


ALTER TABLE auth."user" OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 41421)
-- Name: note; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.note (
    id bigint NOT NULL,
    project_uuid uuid NOT NULL,
    note text NOT NULL
);


ALTER TABLE public.note OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 41420)
-- Name: note_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.note_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.note_id_seq OWNER TO postgres;

--
-- TOC entry 4862 (class 0 OID 0)
-- Dependencies: 226
-- Name: note_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.note_id_seq OWNED BY public.note.id;


--
-- TOC entry 223 (class 1259 OID 41388)
-- Name: permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permissions (
    project_uuid uuid NOT NULL,
    user_uuid uuid NOT NULL,
    perms json NOT NULL
);


ALTER TABLE public.permissions OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 41375)
-- Name: project; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.project (
    uuid uuid DEFAULT gen_random_uuid() NOT NULL,
    name text NOT NULL,
    owner_uuid uuid NOT NULL,
    description text
);


ALTER TABLE public.project OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 41406)
-- Name: task; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.task (
    id bigint NOT NULL,
    project_uuid uuid NOT NULL,
    status smallint DEFAULT 0 NOT NULL,
    name text NOT NULL,
    description text
);


ALTER TABLE public.task OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 41405)
-- Name: task_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.task_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.task_id_seq OWNER TO postgres;

--
-- TOC entry 4863 (class 0 OID 0)
-- Dependencies: 224
-- Name: task_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.task_id_seq OWNED BY public.task.id;


--
-- TOC entry 219 (class 1259 OID 41328)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    uuid uuid DEFAULT gen_random_uuid() NOT NULL,
    displayname text NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- TOC entry 4678 (class 2604 OID 41424)
-- Name: note id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note ALTER COLUMN id SET DEFAULT nextval('public.note_id_seq'::regclass);


--
-- TOC entry 4676 (class 2604 OID 41409)
-- Name: task id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.task ALTER COLUMN id SET DEFAULT nextval('public.task_id_seq'::regclass);


--
-- TOC entry 4850 (class 0 OID 41367)
-- Dependencies: 221
-- Data for Name: api; Type: TABLE DATA; Schema: auth; Owner: postgres
--

COPY auth.api (uuid, bcrypt) FROM stdin;
\.


--
-- TOC entry 4849 (class 0 OID 41341)
-- Dependencies: 220
-- Data for Name: session; Type: TABLE DATA; Schema: auth; Owner: postgres
--

COPY auth.session (uuid, user_uuid, start, heartbeat, valid, ip) FROM stdin;
\.


--
-- TOC entry 4847 (class 0 OID 41321)
-- Dependencies: 218
-- Data for Name: user; Type: TABLE DATA; Schema: auth; Owner: postgres
--

COPY auth."user" (username, bcrypt, user_uuid) FROM stdin;
\.


--
-- TOC entry 4856 (class 0 OID 41421)
-- Dependencies: 227
-- Data for Name: note; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.note (id, project_uuid, note) FROM stdin;
\.


--
-- TOC entry 4852 (class 0 OID 41388)
-- Dependencies: 223
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permissions (project_uuid, user_uuid, perms) FROM stdin;
\.


--
-- TOC entry 4851 (class 0 OID 41375)
-- Dependencies: 222
-- Data for Name: project; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.project (uuid, name, owner_uuid, description) FROM stdin;
\.


--
-- TOC entry 4854 (class 0 OID 41406)
-- Dependencies: 225
-- Data for Name: task; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.task (id, project_uuid, status, name, description) FROM stdin;
\.


--
-- TOC entry 4848 (class 0 OID 41328)
-- Dependencies: 219
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (uuid, displayname) FROM stdin;
\.


--
-- TOC entry 4864 (class 0 OID 0)
-- Dependencies: 226
-- Name: note_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.note_id_seq', 1, false);


--
-- TOC entry 4865 (class 0 OID 0)
-- Dependencies: 224
-- Name: task_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.task_id_seq', 1, false);


--
-- TOC entry 4686 (class 2606 OID 41374)
-- Name: api api_pkey; Type: CONSTRAINT; Schema: auth; Owner: postgres
--

ALTER TABLE ONLY auth.api
    ADD CONSTRAINT api_pkey PRIMARY KEY (uuid);


--
-- TOC entry 4684 (class 2606 OID 41347)
-- Name: session session_pkey; Type: CONSTRAINT; Schema: auth; Owner: postgres
--

ALTER TABLE ONLY auth.session
    ADD CONSTRAINT session_pkey PRIMARY KEY (uuid);


--
-- TOC entry 4680 (class 2606 OID 41327)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: auth; Owner: postgres
--

ALTER TABLE ONLY auth."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (username);


--
-- TOC entry 4694 (class 2606 OID 41428)
-- Name: note note_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT note_pkey PRIMARY KEY (id);


--
-- TOC entry 4690 (class 2606 OID 41394)
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (project_uuid, user_uuid);


--
-- TOC entry 4688 (class 2606 OID 41382)
-- Name: project project_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project
    ADD CONSTRAINT project_pkey PRIMARY KEY (uuid);


--
-- TOC entry 4692 (class 2606 OID 41412)
-- Name: task task_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.task
    ADD CONSTRAINT task_pkey PRIMARY KEY (id);


--
-- TOC entry 4682 (class 2606 OID 41335)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (uuid);


--
-- TOC entry 4696 (class 2606 OID 41348)
-- Name: session session_user_uuid_fkey; Type: FK CONSTRAINT; Schema: auth; Owner: postgres
--

ALTER TABLE ONLY auth.session
    ADD CONSTRAINT session_user_uuid_fkey FOREIGN KEY (user_uuid) REFERENCES public."user"(uuid);


--
-- TOC entry 4695 (class 2606 OID 41336)
-- Name: user user_user_uuid_fkey; Type: FK CONSTRAINT; Schema: auth; Owner: postgres
--

ALTER TABLE ONLY auth."user"
    ADD CONSTRAINT user_user_uuid_fkey FOREIGN KEY (user_uuid) REFERENCES public."user"(uuid) NOT VALID;


--
-- TOC entry 4701 (class 2606 OID 41429)
-- Name: note note_project_uuid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT note_project_uuid_fkey FOREIGN KEY (project_uuid) REFERENCES public.project(uuid);


--
-- TOC entry 4698 (class 2606 OID 41395)
-- Name: permissions permissions_project_uuid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_project_uuid_fkey FOREIGN KEY (project_uuid) REFERENCES public.project(uuid) NOT VALID;


--
-- TOC entry 4699 (class 2606 OID 41400)
-- Name: permissions permissions_user_uuid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_user_uuid_fkey FOREIGN KEY (user_uuid) REFERENCES public."user"(uuid) NOT VALID;


--
-- TOC entry 4697 (class 2606 OID 41383)
-- Name: project project_owner_uuid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project
    ADD CONSTRAINT project_owner_uuid_fkey FOREIGN KEY (owner_uuid) REFERENCES public."user"(uuid);


--
-- TOC entry 4700 (class 2606 OID 41413)
-- Name: task task_project_uuid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.task
    ADD CONSTRAINT task_project_uuid_fkey FOREIGN KEY (project_uuid) REFERENCES public.project(uuid);


-- Completed on 2026-03-01 00:10:59

--
-- PostgreSQL database dump complete
--

\unrestrict pDuaiOLOCaMKV8vR09VMyoxwonDWhR26mbzOB2p1wcQ5oKvIDGDlvVYMawtH2yi

