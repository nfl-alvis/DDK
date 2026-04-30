// lib/app/routes/app_pages.dart

import 'package:get/get.dart';
import '../modules/splash/splash_page.dart';
import '../modules/splash/splash_binding.dart';
import '../modules/home/home_page.dart';
import '../modules/home/home_binding.dart';
import '../modules/galeri/galeri_page.dart';
import '../modules/galeri/galeri_binding.dart';
import '../modules/puzzle/puzzle_page.dart';
import '../modules/puzzle/puzzle_binding.dart';
import '../modules/panduan/panduan_page.dart';
import '../modules/panduan/panduan_binding.dart';
import '../modules/tentang/tentang_page.dart';
import '../modules/tentang/tentang_binding.dart';
import 'app_routes.dart';

class AppPages {
  static final pages = [
    GetPage(
      name: Routes.SPLASH,
      page: () => const SplashPage(),
      binding: SplashBinding(),
    ),
    GetPage(
      name: Routes.HOME,
      page: () => const HomePage(),
      binding: HomeBinding(),
      transition: Transition.fadeIn,
    ),
    GetPage(
      name: Routes.GALERI,
      page: () => const GaleriPage(),
      binding: GaleriBinding(),
      transition: Transition.rightToLeft,
    ),
    GetPage(
      name: Routes.PUZZLE,
      page: () => const PuzzlePage(),
      binding: PuzzleBinding(),
      transition: Transition.zoom,
    ),
    GetPage(
      name: Routes.PANDUAN,
      page: () => const PanduanPage(),
      binding: PanduanBinding(),
      transition: Transition.rightToLeft,
    ),
    GetPage(
      name: Routes.TENTANG,
      page: () => const TentangPage(),
      binding: TentangBinding(),
      transition: Transition.rightToLeft,
    ),
  ];
}
