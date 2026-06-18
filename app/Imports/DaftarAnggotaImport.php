<?php

namespace App\Imports;

use App\Models\DaftarAnggotaModels;

/**
 * Import Daftar Anggota dari Excel/CSV/ODS.
 * Header: no_registrasi, name, jenis_kelamin, role_pkk, keanggotaan_tp_pkk,
 *         kader_umum, kader_khusus, tempat_lahir, tanggal_lahir, umur,
 *         status_perkawinan, alamat, pendidikan, pekerjaan, keterangan, email, notelp
 * CATATAN: kolom foto dan id_users tidak bisa diimport via file Excel.
 */
class DaftarAnggotaImport extends BaseImport
{
    protected string $rolePkk;

    protected array $headerAliases = [
        'no registrasi'      => 'no_registrasi',
        'nomor registrasi'   => 'no_registrasi',
        'nama'               => 'name',
        'jenis kelamin'      => 'jenis_kelamin',
        'role pkk'           => 'role_pkk',
        'keanggotaan tp pkk' => 'keanggotaan_tp_pkk',
        'keanggotaan'        => 'keanggotaan_tp_pkk',
        'kader umum'         => 'kader_umum',
        'kader khusus'       => 'kader_khusus',
        'tempat lahir'       => 'tempat_lahir',
        'tanggal lahir'      => 'tanggal_lahir',
        'tgl lahir'          => 'tanggal_lahir',
        'tgl_lahir'          => 'tanggal_lahir',
        'status perkawinan'  => 'status_perkawinan',
        'no telp'            => 'notelp',
        'no_telp'            => 'notelp',
        'nomor telepon'      => 'notelp',
    ];

    public function __construct(string $rolePkk)
    {
        $this->rolePkk = $rolePkk;
    }

    protected function processRow(array $row): void
    {
        if (empty($row['name']) && empty($row['nama'])) return;

        $kaderUmum  = $this->parseBool($row['kader_umum'] ?? null);
        $kaderKhusus = $this->parseBool($row['kader_khusus'] ?? null);

        DaftarAnggotaModels::create([
            'id_users'           => null,
            'no_registrasi'      => $row['no_registrasi'] ?? null,
            'name'               => $row['name'] ?? $row['nama'] ?? null,
            'jenis_kelamin'      => $row['jenis_kelamin'] ?? null,
            'role_pkk'           => $row['role_pkk'] ?? $this->rolePkk,
            'keanggotaan_tp_pkk' => $row['keanggotaan_tp_pkk'] ?? null,
            'kader_umum'         => $kaderUmum,
            'kader_khusus'       => $kaderKhusus,
            'tempat_lahir'       => $row['tempat_lahir'] ?? null,
            'tanggal_lahir'      => $this->parseDate($row['tanggal_lahir'] ?? null),
            'umur'               => $this->parseInt($row['umur'] ?? null),
            'status_perkawinan'  => $row['status_perkawinan'] ?? null,
            'alamat'             => $row['alamat'] ?? null,
            'pendidikan'         => $row['pendidikan'] ?? null,
            'pekerjaan'          => $row['pekerjaan'] ?? null,
            'keterangan'         => $row['keterangan'] ?? null,
            'email'              => $row['email'] ?? null,
            'notelp'             => $row['notelp'] ?? null,
        ]);
    }

    private function parseBool($value): bool
    {
        if (is_null($value)) return false;
        $v = strtolower(trim((string) $value));
        return in_array($v, ['1', 'true', 'ya', 'yes', 'y', 'v', '✓']);
    }
}
