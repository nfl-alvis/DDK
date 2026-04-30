// lib/app/modules/puzzle/puzzle_binding.dart

import 'package:get/get.dart';
import 'puzzle_controller.dart';

class PuzzleBinding extends Bindings {
  @override
  void dependencies() {
    Get.put<PuzzleController>(PuzzleController());
  }
}
