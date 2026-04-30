// lib/app/modules/galeri/galeri_controller.dart

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../data/food_model.dart';

class GaleriController extends GetxController {
  final List<FoodModel> foodList = daftarMakanan;

  // Filter state
  final RxString selectedCategory = 'Semua'.obs;
  final List<String> categories = ['Semua', 'Nasi', 'Daging', 'Sup', 'Sayuran'];

  List<FoodModel> get filteredList {
    if (selectedCategory.value == 'Semua') return foodList;
    return foodList
        .where((f) => f.category == selectedCategory.value)
        .toList();
  }

  void setCategory(String category) {
    selectedCategory.value = category;
  }

  void showFoodDetail(FoodModel food) {
    Get.dialog(
      Dialog(
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
        child: _FoodDetailDialog(food: food),
      ),
    );
  }
}

class _FoodDetailDialog extends StatelessWidget {
  final FoodModel food;
  const _FoodDetailDialog({required this.food});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(20),
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          // Gambar
          ClipRRect(
            borderRadius: BorderRadius.circular(14),
            child: Image.asset(
              food.imagePath,
              height: 160,
              width: double.infinity,
              fit: BoxFit.cover,
              errorBuilder: (_, __, ___) => Container(
                height: 160,
                color: Colors.grey.shade200,
                child: const Icon(Icons.fastfood, size: 60, color: Colors.grey),
              ),
            ),
          ),
          const SizedBox(height: 16),

          // Nama
          Text(
            food.name,
            style: TextStyle(
              fontSize: 22,
              fontWeight: FontWeight.bold,
              color: Colors.brown.shade800,
            ),
          ),
          const SizedBox(height: 4),

          // Origin badge
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
            decoration: BoxDecoration(
              color: Colors.orange.shade100,
              borderRadius: BorderRadius.circular(20),
              border: Border.all(color: Colors.orange.shade300),
            ),
            child: Text(
              '📍 ${food.origin}',
              style: TextStyle(
                fontSize: 12,
                color: Colors.orange.shade800,
                fontWeight: FontWeight.w600,
              ),
            ),
          ),
          const SizedBox(height: 12),

          // Deskripsi
          Text(
            food.description,
            style: TextStyle(
              fontSize: 13,
              color: Colors.grey.shade700,
              height: 1.5,
            ),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 16),

          // Tombol tutup
          ElevatedButton(
            onPressed: () => Get.back(),
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.brown.shade600,
              foregroundColor: Colors.white,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(12),
              ),
              padding: const EdgeInsets.symmetric(horizontal: 32, vertical: 10),
            ),
            child: const Text('Tutup'),
          ),
        ],
      ),
    );
  }
}
