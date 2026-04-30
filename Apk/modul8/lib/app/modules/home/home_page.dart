import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../galeri/galeri_page.dart';
import '../level/level_page.dart';
import '../panduan/panduan_page.dart';
import '../puzzle/puzzle_page.dart';
import '../tentang/tentang_page.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  bool _isLoading = true;

  @override
  void didChangeDependencies() {
    super.didChangeDependencies();
    _precacheImages();
  }

  Future<void> _precacheImages() async {
    try {
      await Future.wait([
        precacheImage(const AssetImage('assets/images/Bg.jpg'), context),
        precacheImage(const AssetImage('assets/images/Logo.png'), context),
        precacheImage(
          const AssetImage('assets/buttons/BtnMulaiPermainan.png'),
          context,
        ),
        precacheImage(
          const AssetImage('assets/buttons/BtnPilihLevel.png'),
          context,
        ),
        precacheImage(
          const AssetImage('assets/buttons/BtnGaleriMakanan.png'),
          context,
        ),
        precacheImage(
          const AssetImage('assets/buttons/BtnTentangGame2.png'),
          context,
        ),
        precacheImage(
          const AssetImage('assets/buttons/BtnPanduan2.png'),
          context,
        ),
        precacheImage(
          const AssetImage('assets/buttons/BtnPengaturan.png'),
          context,
        ),
      ]);

      if (mounted) {
        setState(() {
          _isLoading = false;
        });
      }
    } catch (e) {
      debugPrint('Error loading images: $e');
      if (mounted) {
        setState(() {
          _isLoading = false;
        });
      }
    }
  }

  void _onStartGame() {
    Get.to(() => const PuzzlePage());
  }

  void _onChooseLevel() {
    Get.to(() => const LevelPage());
  }

  void _onFoodGallery() {
    Get.to(() => const GaleriPage());
  }

  void _onAboutGame() {
    Get.to(() => const TentangPage());
  }

  void _onGuide() {
    Get.to(() => const PanduanPage());
  }

  @override
  Widget build(BuildContext context) {
    final screenWidth = MediaQuery.of(context).size.width;
    final screenHeight = MediaQuery.of(context).size.height;

    if (_isLoading) {
      return const Scaffold(body: Center(child: CircularProgressIndicator()));
    }

    return Scaffold(
      body: Stack(
        fit: StackFit.expand,
        children: [
          Image.asset(
            'assets/images/Bg.jpg',
            fit: BoxFit.cover,
            errorBuilder: (context, error, stackTrace) {
              return Container(
                color: Colors.blue.shade200,
                child: const Center(
                  child: Icon(Icons.error, size: 50, color: Colors.red),
                ),
              );
            },
          ),
          SafeArea(
            child: Column(
              children: [
                SizedBox(height: screenHeight * 0.02),
                Image.asset(
                  'assets/images/Logo.png',
                  width: screenWidth * 0.9,
                  errorBuilder: (context, error, stackTrace) {
                    return const Icon(
                      Icons.videogame_asset,
                      size: 100,
                      color: Colors.white,
                    );
                  },
                ),
                SizedBox(height: screenHeight * 0.06),
                Expanded(
                  child: SingleChildScrollView(
                    child: Column(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        GameButton(
                          assetPath: 'assets/buttons/BtnMulaiPermainan.png',
                          width: screenWidth * 0.45,
                          onTap: _onStartGame,
                          semanticLabel: 'Mulai Permainan',
                        ),
                        const SizedBox(height: 16),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            GameButton(
                              assetPath: 'assets/buttons/BtnPilihLevel.png',
                              width: screenWidth * 0.37,
                              onTap: _onChooseLevel,
                              semanticLabel: 'Pilih Level',
                            ),
                            const SizedBox(width: 20),
                            GameButton(
                              assetPath: 'assets/buttons/BtnGaleriMakanan.png',
                              width: screenWidth * 0.37,
                              onTap: _onFoodGallery,
                              semanticLabel: 'Galeri Makanan',
                            ),
                          ],
                        ),
                        const SizedBox(height: 16),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            GameButton(
                              assetPath: 'assets/buttons/BtnTentangGame2.png',
                              width: screenWidth * 0.37,
                              onTap: _onAboutGame,
                              semanticLabel: 'Tentang Game',
                            ),
                            const SizedBox(width: 20),
                            GameButton(
                              assetPath: 'assets/buttons/BtnPanduan2.png',
                              width: screenWidth * 0.37,
                              onTap: _onGuide,
                              semanticLabel: 'Panduan',
                            ),
                          ],
                        ),
                        const SizedBox(height: 20),
                      ],
                    ),
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

class GameButton extends StatefulWidget {
  final String assetPath;
  final double width;
  final VoidCallback onTap;
  final String semanticLabel;

  const GameButton({
    required this.assetPath,
    required this.width,
    required this.onTap,
    required this.semanticLabel,
    super.key,
  });

  @override
  State<GameButton> createState() => _GameButtonState();
}

class _GameButtonState extends State<GameButton>
    with SingleTickerProviderStateMixin {
  late AnimationController _controller;
  late Animation<double> _scaleAnimation;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
      duration: const Duration(milliseconds: 100),
      vsync: this,
    );
    _scaleAnimation = Tween<double>(
      begin: 1.0,
      end: 0.95,
    ).animate(CurvedAnimation(parent: _controller, curve: Curves.easeInOut));
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  void _handleTapDown(TapDownDetails details) {
    _controller.forward();
  }

  void _handleTapUp(TapUpDetails details) {
    _controller.reverse();
    widget.onTap();
  }

  void _handleTapCancel() {
    _controller.reverse();
  }

  @override
  Widget build(BuildContext context) {
    return Semantics(
      button: true,
      label: widget.semanticLabel,
      child: GestureDetector(
        onTapDown: _handleTapDown,
        onTapUp: _handleTapUp,
        onTapCancel: _handleTapCancel,
        child: ScaleTransition(
          scale: _scaleAnimation,
          child: Image.asset(
            widget.assetPath,
            width: widget.width,
            errorBuilder: (context, error, stackTrace) {
              return Container(
                width: widget.width,
                height: widget.width * 0.4,
                decoration: BoxDecoration(
                  color: Colors.grey.shade300,
                  borderRadius: BorderRadius.circular(12),
                ),
                child: Center(
                  child: Text(
                    widget.semanticLabel,
                    style: const TextStyle(
                      color: Colors.black54,
                      fontWeight: FontWeight.bold,
                    ),
                    textAlign: TextAlign.center,
                  ),
                ),
              );
            },
          ),
        ),
      ),
    );
  }
}
