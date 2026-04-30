// lib/app/data/food_model.dart

class FoodModel {
  final String id;
  final String name;
  final String imagePath;
  final String description;
  final String origin;
  final String category;

  const FoodModel({
    required this.id,
    required this.name,
    required this.imagePath,
    required this.description,
    required this.origin,
    required this.category,
  });
}

// ===== DAFTAR MAKANAN =====
final List<FoodModel> daftarMakanan = const [
  FoodModel(
    id: '1',
    name: 'Nasi Goreng',
    imagePath: 'assets/foods/nasi_goreng.png',
    description:
        'Nasi goreng adalah makanan khas Indonesia yang dibuat dari nasi yang digoreng dengan bumbu seperti bawang dan kecap, sehingga rasanya gurih dan aromanya khas.',
    origin: 'Nasional',
    category: 'Nasi',
  ),
  FoodModel(
    id: '2',
    name: 'Sate Ayam',
    imagePath: 'assets/foods/sate.png',
    description:
        'Sate adalah makanan khas Indonesia berupa daging yang ditusuk, dibakar, lalu disajikan dengan bumbu seperti kacang atau kecap.',
    origin: 'Jawa',
    category: 'Daging',
  ),
  FoodModel(
    id: '3',
    name: 'Rendang',
    imagePath: 'assets/foods/rendang.png',
    description:
        'Rendang adalah masakan khas Minangkabau berupa daging yang dimasak lama dengan santan dan rempah-rempah hingga bumbunya meresap dan rasanya kaya.',
    origin: 'Sumatra Barat',
    category: 'Daging',
  ),
  FoodModel(
    id: '4',
    name: 'Gado-Gado',
    imagePath: 'assets/foods/gado_gado.png',
    description:
        'Gado-gado adalah makanan khas Indonesia berisi sayuran rebus yang disiram bumbu kacang, biasanya ditambah lontong, tahu, tempe, dan telur.',
    origin: 'Jakarta',
    category: 'Sayuran',
  ),
  FoodModel(
    id: '5',
    name: 'Soto Ayam',
    imagePath: 'assets/foods/soto_ayam.png',
    description:
        'Soto ayam adalah sup khas Indonesia dengan kuah kuning gurih, berisi suwiran ayam dan biasanya disajikan dengan nasi, telur, serta taburan bawang goreng.',
    origin: 'Jawa',
    category: 'Sup',
  ),
  FoodModel(
    id: '6',
    name: 'Rawon',
    imagePath: 'assets/foods/rawon.png',
    description:
        'Rawon adalah sup daging khas Jawa Timur dengan kuah hitam dari kluwek, rasanya gurih dan aromanya khas.',
    origin: 'Jawa Timur',
    category: 'Sup',
  ),
];
