--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.2
-- Dumped by pg_dump version 9.5.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE failed_jobs (
    id integer NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) with time zone NOT NULL
);


ALTER TABLE failed_jobs OWNER TO snek;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: snek
--

CREATE SEQUENCE failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE failed_jobs_id_seq OWNER TO snek;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: snek
--

ALTER SEQUENCE failed_jobs_id_seq OWNED BY failed_jobs.id;


--
-- Name: game_mod; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE game_mod (
    game_id integer NOT NULL,
    mod_id integer NOT NULL
);


ALTER TABLE game_mod OWNER TO snek;

--
-- Name: games; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE games (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    port integer,
    masterpw character varying(255) NOT NULL,
    era integer NOT NULL,
    hours integer,
    hofsize integer,
    indepstr integer,
    magicsites integer,
    eventrarity integer,
    richness integer,
    resources integer,
    startprov integer,
    victorycond integer NOT NULL,
    requiredap integer,
    lvl1thrones integer,
    lvl2thrones integer,
    lvl3thrones integer,
    totalvp integer,
    requiredvp integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    state integer DEFAULT 0 NOT NULL,
    user_id integer NOT NULL,
    research integer,
    supplies integer,
    renaming boolean DEFAULT true NOT NULL,
    storyevents boolean DEFAULT false NOT NULL,
    teamgame boolean DEFAULT false NOT NULL,
    noartrest boolean DEFAULT false NOT NULL,
    clustered boolean DEFAULT false NOT NULL,
    scoregraphs boolean DEFAULT false NOT NULL,
    nonationinfo boolean DEFAULT false NOT NULL,
    map_id integer NOT NULL,
    deleted_at timestamp(0) without time zone,
    status integer DEFAULT 0 NOT NULL,
    journal text,
    shortname character varying(255) NOT NULL,
    summervp boolean DEFAULT false NOT NULL,
    capitalvp boolean DEFAULT false NOT NULL
);


ALTER TABLE games OWNER TO snek;

--
-- Name: games_id_seq; Type: SEQUENCE; Schema: public; Owner: snek
--

CREATE SEQUENCE games_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE games_id_seq OWNER TO snek;

--
-- Name: games_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: snek
--

ALTER SEQUENCE games_id_seq OWNED BY games.id;


--
-- Name: jobs; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE jobs OWNER TO snek;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: snek
--

CREATE SEQUENCE jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE jobs_id_seq OWNER TO snek;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: snek
--

ALTER SEQUENCE jobs_id_seq OWNED BY jobs.id;


--
-- Name: lobbies; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE lobbies (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    server_address character varying(255) NOT NULL,
    server_port integer NOT NULL,
    maxplayers integer NOT NULL,
    status integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE lobbies OWNER TO snek;

--
-- Name: lobbies_id_seq; Type: SEQUENCE; Schema: public; Owner: snek
--

CREATE SEQUENCE lobbies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lobbies_id_seq OWNER TO snek;

--
-- Name: lobbies_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: snek
--

ALTER SEQUENCE lobbies_id_seq OWNED BY lobbies.id;


--
-- Name: maps; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE maps (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    filename character varying(255) NOT NULL,
    provinces integer NOT NULL,
    imagefile character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    user_id integer NOT NULL
);


ALTER TABLE maps OWNER TO snek;

--
-- Name: maps_id_seq; Type: SEQUENCE; Schema: public; Owner: snek
--

CREATE SEQUENCE maps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE maps_id_seq OWNER TO snek;

--
-- Name: maps_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: snek
--

ALTER SEQUENCE maps_id_seq OWNED BY maps.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE migrations (
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE migrations OWNER TO snek;

--
-- Name: mods; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE mods (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    filename character varying(255) NOT NULL,
    version character varying(255) NOT NULL,
    icon character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    user_id integer NOT NULL
);


ALTER TABLE mods OWNER TO snek;

--
-- Name: mods_id_seq; Type: SEQUENCE; Schema: public; Owner: snek
--

CREATE SEQUENCE mods_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mods_id_seq OWNER TO snek;

--
-- Name: mods_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: snek
--

ALTER SEQUENCE mods_id_seq OWNED BY mods.id;


--
-- Name: nations; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE nations (
    id integer NOT NULL,
    nation_id integer NOT NULL,
    era integer,
    name character varying(255),
    epithet character varying(255),
    brief character varying(255),
    description text,
    implemented_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    flag character varying(255)
);


ALTER TABLE nations OWNER TO snek;

--
-- Name: nations_id_seq; Type: SEQUENCE; Schema: public; Owner: snek
--

CREATE SEQUENCE nations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nations_id_seq OWNER TO snek;

--
-- Name: nations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: snek
--

ALTER SEQUENCE nations_id_seq OWNED BY nations.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE password_resets OWNER TO snek;

--
-- Name: signups; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE signups (
    id integer NOT NULL,
    user_id integer,
    lobby_id integer NOT NULL,
    nation_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    write_in character varying(255)
);


ALTER TABLE signups OWNER TO snek;

--
-- Name: signups_id_seq; Type: SEQUENCE; Schema: public; Owner: snek
--

CREATE SEQUENCE signups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE signups_id_seq OWNER TO snek;

--
-- Name: signups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: snek
--

ALTER SEQUENCE signups_id_seq OWNED BY signups.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: snek
--

CREATE TABLE users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    state integer DEFAULT 0 NOT NULL,
    is_admin boolean DEFAULT false NOT NULL,
    is_vouched boolean DEFAULT false NOT NULL,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE users OWNER TO snek;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: snek
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO snek;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: snek
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: snek
--

ALTER TABLE ONLY failed_jobs ALTER COLUMN id SET DEFAULT nextval('failed_jobs_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: snek
--

ALTER TABLE ONLY games ALTER COLUMN id SET DEFAULT nextval('games_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: snek
--

ALTER TABLE ONLY jobs ALTER COLUMN id SET DEFAULT nextval('jobs_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: snek
--

ALTER TABLE ONLY lobbies ALTER COLUMN id SET DEFAULT nextval('lobbies_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: snek
--

ALTER TABLE ONLY maps ALTER COLUMN id SET DEFAULT nextval('maps_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: snek
--

ALTER TABLE ONLY mods ALTER COLUMN id SET DEFAULT nextval('mods_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: snek
--

ALTER TABLE ONLY nations ALTER COLUMN id SET DEFAULT nextval('nations_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: snek
--

ALTER TABLE ONLY signups ALTER COLUMN id SET DEFAULT nextval('signups_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: snek
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Name: failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: game_mod_pkey; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY game_mod
    ADD CONSTRAINT game_mod_pkey PRIMARY KEY (game_id, mod_id);


--
-- Name: games_pkey; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY games
    ADD CONSTRAINT games_pkey PRIMARY KEY (id);


--
-- Name: games_shortname_unique; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY games
    ADD CONSTRAINT games_shortname_unique UNIQUE (shortname);


--
-- Name: jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: lobbies_pkey; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY lobbies
    ADD CONSTRAINT lobbies_pkey PRIMARY KEY (id);


--
-- Name: maps_filename_unique; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY maps
    ADD CONSTRAINT maps_filename_unique UNIQUE (filename);


--
-- Name: maps_pkey; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY maps
    ADD CONSTRAINT maps_pkey PRIMARY KEY (id);


--
-- Name: mods_filename_unique; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY mods
    ADD CONSTRAINT mods_filename_unique UNIQUE (filename);


--
-- Name: mods_pkey; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY mods
    ADD CONSTRAINT mods_pkey PRIMARY KEY (id);


--
-- Name: nations_nation_id_implemented_by_unique; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY nations
    ADD CONSTRAINT nations_nation_id_implemented_by_unique UNIQUE (nation_id, implemented_by);


--
-- Name: nations_pkey; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY nations
    ADD CONSTRAINT nations_pkey PRIMARY KEY (id);


--
-- Name: signups_nation_id_lobby_id_unique; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY signups
    ADD CONSTRAINT signups_nation_id_lobby_id_unique UNIQUE (nation_id, lobby_id);


--
-- Name: signups_pkey; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY signups
    ADD CONSTRAINT signups_pkey PRIMARY KEY (id);


--
-- Name: signups_user_id_lobby_id_unique; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY signups
    ADD CONSTRAINT signups_user_id_lobby_id_unique UNIQUE (user_id, lobby_id);


--
-- Name: users_email_unique; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: game_mod_game_id_index; Type: INDEX; Schema: public; Owner: snek
--

CREATE INDEX game_mod_game_id_index ON game_mod USING btree (game_id);


--
-- Name: game_mod_mod_id_index; Type: INDEX; Schema: public; Owner: snek
--

CREATE INDEX game_mod_mod_id_index ON game_mod USING btree (mod_id);


--
-- Name: jobs_queue_reserved_reserved_at_index; Type: INDEX; Schema: public; Owner: snek
--

CREATE INDEX jobs_queue_reserved_reserved_at_index ON jobs USING btree (queue, reserved, reserved_at);


--
-- Name: nations_nation_id_index; Type: INDEX; Schema: public; Owner: snek
--

CREATE INDEX nations_nation_id_index ON nations USING btree (nation_id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: snek
--

CREATE INDEX password_resets_email_index ON password_resets USING btree (email);


--
-- Name: password_resets_token_index; Type: INDEX; Schema: public; Owner: snek
--

CREATE INDEX password_resets_token_index ON password_resets USING btree (token);


--
-- Name: signups_lobby_id_index; Type: INDEX; Schema: public; Owner: snek
--

CREATE INDEX signups_lobby_id_index ON signups USING btree (lobby_id);


--
-- Name: signups_nation_id_index; Type: INDEX; Schema: public; Owner: snek
--

CREATE INDEX signups_nation_id_index ON signups USING btree (nation_id);


--
-- Name: signups_user_id_index; Type: INDEX; Schema: public; Owner: snek
--

CREATE INDEX signups_user_id_index ON signups USING btree (user_id);


--
-- Name: game_mod_game_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY game_mod
    ADD CONSTRAINT game_mod_game_id_foreign FOREIGN KEY (game_id) REFERENCES games(id) ON DELETE CASCADE;


--
-- Name: game_mod_mod_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY game_mod
    ADD CONSTRAINT game_mod_mod_id_foreign FOREIGN KEY (mod_id) REFERENCES mods(id) ON DELETE CASCADE;


--
-- Name: games_map_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY games
    ADD CONSTRAINT games_map_id_foreign FOREIGN KEY (map_id) REFERENCES maps(id);


--
-- Name: games_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY games
    ADD CONSTRAINT games_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: maps_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY maps
    ADD CONSTRAINT maps_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: mods_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY mods
    ADD CONSTRAINT mods_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: nations_implemented_by_foreign; Type: FK CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY nations
    ADD CONSTRAINT nations_implemented_by_foreign FOREIGN KEY (implemented_by) REFERENCES mods(id);


--
-- Name: signups_lobby_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY signups
    ADD CONSTRAINT signups_lobby_id_foreign FOREIGN KEY (lobby_id) REFERENCES lobbies(id) ON DELETE CASCADE;


--
-- Name: signups_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: snek
--

ALTER TABLE ONLY signups
    ADD CONSTRAINT signups_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

