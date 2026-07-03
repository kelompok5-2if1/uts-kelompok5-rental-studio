# REST API Documentation

## Overview
Complete REST API for Rental Studio Management System with full CRUD operations, JSON responses, validation, and resource collections.

## Base URL
```
http://localhost/api/v1
```

## API Resources

### 1. Pelanggan (Customers)
**Endpoint:** `/api/v1/pelanggan`

**Methods:**
- `GET /pelanggan` - List all customers (paginated, 10 per page)
- `POST /pelanggan` - Create new customer
- `GET /pelanggan/{id}` - Get customer by ID
- `PUT/PATCH /pelanggan/{id}` - Update customer
- `DELETE /pelanggan/{id}` - Delete customer

**Request Fields:**
```json
{
  "nama": "string (required, max:255)",
  "email": "string (required, email, unique)",
  "no_hp": "string (required, max:15)",
  "alamat": "string (required)"
}
```

**Response:**
```json
{
  "id": 1,
  "nama": "John Doe",
  "email": "john@example.com",
  "no_hp": "081234567890",
  "alamat": "Jl. Raya No. 123",
  "created_at": "2026-07-02T10:00:00Z",
  "updated_at": "2026-07-02T10:00:00Z"
}
```

---

### 2. Kategori (Equipment Categories)
**Endpoint:** `/api/v1/kategori`

**Methods:**
- `GET /kategori` - List all categories (paginated, 10 per page)
- `POST /kategori` - Create new category
- `GET /kategori/{id}` - Get category by ID
- `PUT/PATCH /kategori/{id}` - Update category
- `DELETE /kategori/{id}` - Delete category

**Request Fields:**
```json
{
  "nama_kategori": "string (required, unique, max:255)",
  "deskripsi": "string (nullable, min:5)"
}
```

**Response:**
```json
{
  "id": 1,
  "nama_kategori": "Gitar",
  "deskripsi": "Alat musik gitar berkualitas",
  "created_at": "2026-07-02T10:00:00Z",
  "updated_at": "2026-07-02T10:00:00Z"
}
```

---

### 3. Studio
**Endpoint:** `/api/v1/studio`

**Methods:**
- `GET /studio` - List all studios (paginated, 10 per page)
- `POST /studio` - Create new studio
- `GET /studio/{id}` - Get studio by ID
- `PUT/PATCH /studio/{id}` - Update studio
- `DELETE /studio/{id}` - Delete studio

**Request Fields:**
```json
{
  "nama_studio": "string (required, unique, max:255)",
  "kapasitas": "integer (required, min:1)",
  "harga_per_jam": "numeric (required, min:0)",
  "status": "string (required, in:Tersedia,Maintenance)",
  "foto": "file (nullable, image, max:5120KB)"
}
```

**Response:**
```json
{
  "id": 1,
  "nama_studio": "Studio A",
  "kapasitas": 10,
  "harga_per_jam": 250000,
  "status": "Tersedia",
  "foto": "http://localhost/storage/studio/filename.jpg",
  "created_at": "2026-07-02T10:00:00Z",
  "updated_at": "2026-07-02T10:00:00Z"
}
```

---

### 4. Alat Band (Equipment)
**Endpoint:** `/api/v1/alat-band`

**Methods:**
- `GET /alat-band` - List all equipment (paginated, 10 per page)
- `POST /alat-band` - Create new equipment
- `GET /alat-band/{id}` - Get equipment by ID
- `PUT/PATCH /alat-band/{id}` - Update equipment
- `DELETE /alat-band/{id}` - Delete equipment

**Request Fields:**
```json
{
  "nama_alat": "string (required, max:255)",
  "kategori_alat_id": "integer (required, exists:kategoris,id)",
  "stok": "integer (required, min:0)",
  "harga_sewa": "numeric (required, min:0)",
  "kondisi": "string (required, in:Baik,Rusak,Maintenance)",
  "foto": "file (nullable, image, max:5120KB)"
}
```

**Response:**
```json
{
  "id": 1,
  "nama_alat": "Gitar Akustik",
  "kategori_id": 1,
  "kategori": {
    "id": 1,
    "nama_kategori": "Gitar",
    "deskripsi": "Alat musik gitar berkualitas"
  },
  "stok": 5,
  "harga_sewa": 50000,
  "kondisi": "Baik",
  "foto": "http://localhost/storage/alat-band/filename.jpg",
  "created_at": "2026-07-02T10:00:00Z",
  "updated_at": "2026-07-02T10:00:00Z"
}
```

---

### 5. Booking Studio
**Endpoint:** `/api/v1/booking-studio`

**Methods:**
- `GET /booking-studio` - List all bookings (paginated, 10 per page)
- `POST /booking-studio` - Create new booking
- `GET /booking-studio/{id}` - Get booking by ID
- `PUT/PATCH /booking-studio/{id}` - Update booking
- `DELETE /booking-studio/{id}` - Delete booking

**Request Fields:**
```json
{
  "pelanggan_id": "integer (required, exists:pelanggans,id)",
  "studio_id": "integer (required, exists:studios,id)",
  "tanggal_booking": "date (required, after_or_equal:today)",
  "jam_mulai": "time (required, format:H:i)",
  "jam_selesai": "time (required, after:jam_mulai)",
  "total_harga": "numeric (required, min:0)",
  "status": "string (required, in:Pending,Selesai,Batal)"
}
```

**Response:**
```json
{
  "id": 1,
  "pelanggan_id": 1,
  "pelanggan": { ... },
  "studio_id": 1,
  "studio": { ... },
  "tanggal_booking": "2026-07-10",
  "jam_mulai": "14:00",
  "jam_selesai": "16:00",
  "total_harga": 500000,
  "status": "Selesai",
  "created_at": "2026-07-02T10:00:00Z",
  "updated_at": "2026-07-02T10:00:00Z"
}
```

---

### 6. Rental Alat (Equipment Rental)
**Endpoint:** `/api/v1/rental-alat`

**Methods:**
- `GET /rental-alat` - List all rentals (paginated, 10 per page)
- `POST /rental-alat` - Create new rental
- `GET /rental-alat/{id}` - Get rental by ID
- `PUT/PATCH /rental-alat/{id}` - Update rental
- `DELETE /rental-alat/{id}` - Delete rental

**Request Fields:**
```json
{
  "pelanggan_id": "integer (required, exists:pelanggans,id)",
  "alat_band_id": "integer (required, exists:alat_bands,id)",
  "tanggal_sewa": "date (required)",
  "tanggal_kembali": "date (required, after_or_equal:tanggal_sewa)",
  "jumlah": "integer (required, min:1)",
  "total_harga": "numeric (required, min:0)",
  "status": "string (required, in:Dipinjam,Dikembalikan)"
}
```

**Response:**
```json
{
  "id": 1,
  "pelanggan_id": 1,
  "pelanggan": { ... },
  "alat_band_id": 1,
  "alat_band": { ... },
  "tanggal_sewa": "2026-07-03",
  "tanggal_kembali": "2026-07-10",
  "jumlah": 2,
  "total_harga": 700000,
  "status": "Dipinjam",
  "created_at": "2026-07-02T10:00:00Z",
  "updated_at": "2026-07-02T10:00:00Z"
}
```

---

### 7. Detail Rental (Rental Details)
**Endpoint:** `/api/v1/detail-rental`

**Methods:**
- `GET /detail-rental` - List all rental details (paginated, 10 per page)
- `POST /detail-rental` - Create new rental detail
- `GET /detail-rental/{id}` - Get rental detail by ID
- `PUT/PATCH /detail-rental/{id}` - Update rental detail
- `DELETE /detail-rental/{id}` - Delete rental detail

**Request Fields:**
```json
{
  "rental_alat_id": "integer (required, exists:rental_alats,id)",
  "alat_band_id": "integer (required, exists:alat_bands,id)",
  "jumlah": "integer (required, min:1)",
  "durasi": "integer (required, min:1)",
  "subtotal": "numeric (required, min:0.01)"
}
```

**Response:**
```json
{
  "id": 1,
  "rental_alat_id": 1,
  "rental_alat": { ... },
  "alat_band_id": 1,
  "alat_band": { ... },
  "jumlah": 2,
  "durasi": 7,
  "subtotal": 700000,
  "created_at": "2026-07-02T10:00:00Z",
  "updated_at": "2026-07-02T10:00:00Z"
}
```

---

### 8. Pembayaran (Payments)
**Endpoint:** `/api/v1/pembayaran`

**Methods:**
- `GET /pembayaran` - List all payments (paginated, 10 per page)
- `POST /pembayaran` - Create new payment
- `GET /pembayaran/{id}` - Get payment by ID
- `PUT/PATCH /pembayaran/{id}` - Update payment
- `DELETE /pembayaran/{id}` - Delete payment

**Request Fields:**
```json
{
  "rental_alat_id": "integer (required, exists:rental_alats,id)",
  "tanggal_bayar": "date (required)",
  "metode_bayar": "string (required, in:Cash,Transfer,CC)",
  "total_bayar": "numeric (required, min:0)",
  "status": "string (required, in:Pending,Lunas)"
}
```

**Response:**
```json
{
  "id": 1,
  "rental_alat_id": 1,
  "rental_alat": { ... },
  "tanggal_bayar": "2026-07-10",
  "metode_bayar": "Transfer",
  "total_bayar": 700000,
  "status": "Lunas",
  "created_at": "2026-07-02T10:00:00Z",
  "updated_at": "2026-07-02T10:00:00Z"
}
```

---

### 9. Laporan Rental (Rental Reports)
**Endpoint:** `/api/v1/laporan-rental`

**Methods:**
- `GET /laporan-rental` - List all reports (paginated, 10 per page)
- `POST /laporan-rental` - Create new report
- `GET /laporan-rental/{id}` - Get report by ID
- `PUT/PATCH /laporan-rental/{id}` - Update report
- `DELETE /laporan-rental/{id}` - Delete report

**Request Fields:**
```json
{
  "tanggal_laporan": "date (required, unique)",
  "total_transaksi": "integer (required, min:0)",
  "total_pendapatan": "numeric (required, min:0)",
  "keterangan": "string (nullable)"
}
```

**Response:**
```json
{
  "id": 1,
  "tanggal_laporan": "2026-07-02",
  "total_transaksi": 5,
  "total_pendapatan": 3500000,
  "keterangan": "Laporan harian",
  "created_at": "2026-07-02T10:00:00Z",
  "updated_at": "2026-07-02T10:00:00Z"
}
```

---

## Collection Response Format

All list endpoints return paginated collections:

```json
{
  "data": [
    { ...resource... },
    { ...resource... }
  ],
  "meta": {
    "total": 25
  },
  "links": {
    "first": "http://localhost/api/v1/resource?page=1",
    "last": "http://localhost/api/v1/resource?page=3",
    "prev": null,
    "next": "http://localhost/api/v1/resource?page=2"
  },
  "path": "http://localhost/api/v1/resource",
  "per_page": 10,
  "from": 1,
  "to": 10,
  "current_page": 1,
  "last_page": 3
}
```

---

## Error Responses

### Validation Error (422)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "nama": ["The nama field is required."],
    "email": ["The email must be a valid email address."]
  }
}
```

### Not Found (404)
```json
{
  "message": "Not found."
}
```

### Delete Success (200)
```json
{
  "message": "Resource deleted successfully"
}
```

---

## HTTP Status Codes

| Code | Meaning |
|------|---------|
| 200 | OK - Successful GET, PUT, PATCH, DELETE |
| 201 | Created - Successful POST |
| 400 | Bad Request |
| 404 | Not Found |
| 422 | Unprocessable Entity - Validation error |
| 500 | Internal Server Error |

---

## Example cURL Requests

### Get all customers
```bash
curl -X GET http://localhost/api/v1/pelanggan
```

### Create new customer
```bash
curl -X POST http://localhost/api/v1/pelanggan \
  -H "Content-Type: application/json" \
  -d '{
    "nama": "John Doe",
    "email": "john@example.com",
    "no_hp": "081234567890",
    "alamat": "Jl. Raya No. 123"
  }'
```

### Update customer
```bash
curl -X PUT http://localhost/api/v1/pelanggan/1 \
  -H "Content-Type: application/json" \
  -d '{
    "nama": "Jane Doe",
    "email": "jane@example.com"
  }'
```

### Delete customer
```bash
curl -X DELETE http://localhost/api/v1/pelanggan/1
```

### Upload file (Studio or Alat Band)
```bash
curl -X POST http://localhost/api/v1/studio \
  -F "nama_studio=Studio A" \
  -F "kapasitas=10" \
  -F "harga_per_jam=250000" \
  -F "status=Tersedia" \
  -F "foto=@/path/to/image.jpg"
```

---

## Features

✅ Full CRUD operations for all 9 entities
✅ JSON responses with proper formatting
✅ Pagination (10 items per page)
✅ Input validation using existing FormRequest classes
✅ Resource collections for consistent response structure
✅ Relationship loading (eager loading with .with())
✅ File upload support (Studios & Equipment)
✅ Proper HTTP status codes
✅ Error handling with validation messages
✅ RESTful API design
