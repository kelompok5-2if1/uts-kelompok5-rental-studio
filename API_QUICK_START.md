# REST API Quick Start Guide

## API Base URL
```
http://localhost/api/v1
```

## Available Endpoints

### All Resources Support Standard CRUD Operations:

```
GET    /pelanggan           - List all (paginated)
POST   /pelanggan           - Create new
GET    /pelanggan/{id}      - Get by ID
PUT    /pelanggan/{id}      - Update
DELETE /pelanggan/{id}      - Delete

GET    /kategori            - List all (paginated)
POST   /kategori            - Create new
GET    /kategori/{id}       - Get by ID
PUT    /kategori/{id}       - Update
DELETE /kategori/{id}       - Delete

GET    /studio              - List all (paginated)
POST   /studio              - Create new (supports file upload)
GET    /studio/{id}         - Get by ID
PUT    /studio/{id}         - Update
DELETE /studio/{id}         - Delete

GET    /alat-band           - List all (paginated)
POST   /alat-band           - Create new (supports file upload)
GET    /alat-band/{id}      - Get by ID
PUT    /alat-band/{id}      - Update
DELETE /alat-band/{id}      - Delete

GET    /booking-studio      - List all (paginated)
POST   /booking-studio      - Create new
GET    /booking-studio/{id} - Get by ID
PUT    /booking-studio/{id} - Update
DELETE /booking-studio/{id} - Delete

GET    /rental-alat         - List all (paginated)
POST   /rental-alat         - Create new
GET    /rental-alat/{id}    - Get by ID
PUT    /rental-alat/{id}    - Update
DELETE /rental-alat/{id}    - Delete

GET    /detail-rental       - List all (paginated)
POST   /detail-rental       - Create new
GET    /detail-rental/{id}  - Get by ID
PUT    /detail-rental/{id}  - Update
DELETE /detail-rental/{id}  - Delete

GET    /pembayaran          - List all (paginated)
POST   /pembayaran          - Create new
GET    /pembayaran/{id}     - Get by ID
PUT    /pembayaran/{id}     - Update
DELETE /pembayaran/{id}     - Delete

GET    /laporan-rental      - List all (paginated)
POST   /laporan-rental      - Create new
GET    /laporan-rental/{id} - Get by ID
PUT    /laporan-rental/{id} - Update
DELETE /laporan-rental/{id} - Delete
```

## Testing with Postman/Insomnia

### 1. Create Customer
```
POST http://localhost/api/v1/pelanggan
Content-Type: application/json

{
  "nama": "John Doe",
  "email": "john@example.com",
  "no_hp": "081234567890",
  "alamat": "Jl. Raya No. 123"
}
```

### 2. Get All Customers
```
GET http://localhost/api/v1/pelanggan
```

### 3. Get Single Customer
```
GET http://localhost/api/v1/pelanggan/1
```

### 4. Update Customer
```
PUT http://localhost/api/v1/pelanggan/1
Content-Type: application/json

{
  "nama": "Jane Doe",
  "email": "jane@example.com"
}
```

### 5. Delete Customer
```
DELETE http://localhost/api/v1/pelanggan/1
```

## File Upload Example (Studio or Alat Band)

### Upload Studio with Photo
```
POST http://localhost/api/v1/studio
(Form-Data)

Key: nama_studio | Value: Studio Besar
Key: kapasitas | Value: 20
Key: harga_per_jam | Value: 500000
Key: status | Value: Tersedia
Key: foto | Value: [Select image file]
```

## Validation Rules

Each resource has built-in validation using the existing FormRequest classes:

- **Pelanggan**: Required fields (nama, email, no_hp, alamat), email must be unique
- **Kategori**: Unique nama_kategori, optional deskripsi
- **Studio**: Unique nama_studio, status must be 'Tersedia' or 'Maintenance', optional foto
- **AlatBand**: Foreign key kategori validation, status must be 'Baik', 'Rusak', or 'Maintenance', optional foto
- **BookingStudio**: Date and time validations, jam_selesai must be after jam_mulai
- **RentalAlat**: Date validations, tanggal_kembali after tanggal_sewa
- **DetailRental**: Numeric subtotal validation
- **Pembayaran**: metode_bayar in 'Cash', 'Transfer', 'CC'
- **LaporanRental**: Unique tanggal_laporan

## Response Format

### Success Response (List)
```json
{
  "data": [
    {
      "id": 1,
      "nama": "John Doe",
      "email": "john@example.com",
      "no_hp": "081234567890",
      "alamat": "Jl. Raya No. 123",
      "created_at": "2026-07-02T10:00:00Z",
      "updated_at": "2026-07-02T10:00:00Z"
    }
  ],
  "meta": {
    "total": 1
  },
  "links": {
    "first": "http://localhost/api/v1/pelanggan?page=1",
    "last": "http://localhost/api/v1/pelanggan?page=1",
    "prev": null,
    "next": null
  },
  "path": "http://localhost/api/v1/pelanggan",
  "per_page": 10,
  "from": 1,
  "to": 1,
  "current_page": 1,
  "last_page": 1
}
```

### Success Response (Single Resource)
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

### Error Response (Validation)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email has already been taken."],
    "no_hp": ["The no hp field is required."]
  }
}
```

## HTTP Status Codes
- **200 OK**: Successful GET, PUT, PATCH, DELETE
- **201 Created**: Successful POST
- **422 Unprocessable Entity**: Validation error
- **404 Not Found**: Resource not found
- **500 Internal Server Error**: Server error

## Features Implemented

✅ RESTful API design with standard CRUD operations
✅ JSON responses for all endpoints
✅ Pagination (10 items per page)
✅ Input validation using FormRequest classes
✅ Resource collections for consistent response structure
✅ Eager loading of relationships (belongsTo, hasMany)
✅ File upload support for Studios and Equipment
✅ Proper HTTP status codes
✅ Error handling with validation messages
✅ Collection responses include metadata and pagination links

## Resource Models & Relationships

- **Pelanggan**: Has many BookingStudio, Has many RentalAlat
- **Kategori**: Has many AlatBand
- **Studio**: Has many BookingStudio
- **AlatBand**: Belongs to Kategori, Has many DetailRental
- **BookingStudio**: Belongs to Pelanggan, Belongs to Studio
- **RentalAlat**: Belongs to Pelanggan, Belongs to AlatBand, Has many DetailRental, Has many Pembayaran
- **DetailRental**: Belongs to RentalAlat, Belongs to AlatBand
- **Pembayaran**: Belongs to RentalAlat
- **LaporanRental**: Independent model for reporting

All relationships are eager-loaded in API responses for better performance.
