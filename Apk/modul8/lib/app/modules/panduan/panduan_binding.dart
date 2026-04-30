// lib/app/modules/panduan/panduan_binding.dart

import 'package:get/get.dart';
import 'panduan_controller.dart';

class PanduanBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<PanduanController>(() => PanduanController());
  }
}
