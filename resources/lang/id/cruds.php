<?php

return [
    'userManagement' => [
        'title'          => 'Manajemen User',
        'title_singular' => 'Manajemen User',
    ],
    'permission' => [
        'title'          => 'Izin',
        'title_singular' => 'Izin',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Peranan',
        'title_singular' => 'Peranan',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Daftar Pengguna',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'agenda' => [
        'title'          => 'Agenda',
        'title_singular' => 'Agenda',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'nama'              => 'Nama',
            'nama_helper'       => ' ',
            'lokasi'            => 'Lokasi',
            'lokasi_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'session' => [
        'title'          => 'Session',
        'title_singular' => 'Session',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'nama_agenda'        => 'Nama Agenda',
            'nama_agenda_helper' => ' ',
            'nama_sesi'          => 'Nama Sesi',
            'nama_sesi_helper'   => ' ',
            'start_time'         => 'Start Time',
            'start_time_helper'  => ' ',
            'end_time'           => 'End Time',
            'end_time_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'pesertum' => [
        'title'          => 'Peserta',
        'title_singular' => 'Peserta',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'nama'                 => 'Nama',
            'nama_helper'          => ' ',
            'asal_dprd'            => 'Asal DPRD',
            'asal_dprd_helper'     => ' ',
            'jenis_kelamin'        => 'Jenis Kelamin',
            'jenis_kelamin_helper' => ' ',
            'nomor_ponsel'         => 'Nomor Ponsel',
            'nomor_ponsel_helper'  => ' ',
            'foto'                 => 'Foto',
            'foto_helper'          => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'uuid'                 => 'Uuid',
            'uuid_helper'          => ' ',
        ],
    ],
    'presensi' => [
        'title'          => 'Presensi',
        'title_singular' => 'Presensi',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'nama_sesi'           => 'Nama Sesi',
            'nama_sesi_helper'    => ' ',
            'nama_peserta'        => 'Nama Peserta',
            'nama_peserta_helper' => ' ',
            'type'                => 'Type',
            'type_helper'         => ' ',
            'status'              => 'Status',
            'status_helper'       => ' ',
            'refer_to'            => 'Refer To',
            'refer_to_helper'     => ' ',
            'waktu'               => 'Waktu',
            'waktu_helper'        => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
];
