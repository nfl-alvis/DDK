import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../cara_bermain/cara_bermain_page.dart';
import '../tips_trik/tips_trik_page.dart';

class PanduanPage extends StatefulWidget {
  const PanduanPage({super.key});

  @override
  State<PanduanPage> createState() => _PanduanPageState();
}

class _PanduanPageState extends State<PanduanPage> {
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
        precacheImage(
          const AssetImage('assets/buttons/BtnKembali2.png'),
          context,
        ),
        precacheImage(
          const AssetImage('assets/buttons/PanduanLogo.png'),
          context,
        ),
        precacheImage(
          const AssetImage('assets/buttons/BtnCaraBermain.png'),
          context,
        ),
        precacheImage(const AssetImage('assets/buttons/BtnTips.png'), context),
      ]);

      if (mounted) {
        setState(() => _isLoading = false);
      }
    } catch (e) {
      debugPrint('Error loading images: $e');
      if (mounted) {
        setState(() => _isLoading = false);
      }
    }
  }

  Widget _buildHeader() {
    return Padding(
      padding: const EdgeInsets.all(16.0),
      child: Row(
        children: [
          _buildBackButton(),
          const SizedBox(width: 14),
          Expanded(child: _buildTitleLogo()),
        ],
      ),
    );
  }

  Widget _buildBackButton() {
    return Material(
      color: Colors.transparent,
      child: InkWell(
        onTap: Get.back,
        borderRadius: BorderRadius.circular(25),
        child: Semantics(
          label: 'Tombol kembali',
          button: true,
          child: Image.asset(
            'assets/buttons/BtnKembali2.png',
            width: 45,
            height: 45,
            errorBuilder: (context, error, stackTrace) {
              return Container(
                width: 45,
                height: 45,
                decoration: BoxDecoration(
                  color: Colors.brown.shade400,
                  shape: BoxShape.circle,
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withValues(alpha: 0.2),
                      blurRadius: 4,
                      offset: const Offset(0, 2),
                    ),
                  ],
                ),
                child: const Icon(
                  Icons.arrow_back,
                  color: Colors.white,
                  size: 24,
                ),
              );
            },
          ),
        ),
      ),
    );
  }

  Widget _buildTitleLogo() {
    return Semantics(
      label: 'Panduan',
      header: true,
      child: Image.asset(
        'assets/buttons/PanduanLogo.png',
        height: 60,
        fit: BoxFit.contain,
        errorBuilder: (context, error, stackTrace) {
          return Container(
            height: 60,
            decoration: BoxDecoration(
              color: Colors.orange.shade200,
              borderRadius: BorderRadius.circular(30),
              border: Border.all(color: Colors.brown.shade800, width: 3),
              boxShadow: [
                BoxShadow(
                  color: Colors.black.withValues(alpha: 0.15),
                  blurRadius: 6,
                  offset: const Offset(0, 3),
                ),
              ],
            ),
            child: const Center(
              child: Text(
                'Panduan',
                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.bold,
                  color: Colors.brown,
                ),
              ),
            ),
          );
        },
      ),
    );
  }

  void _navigateToCaraBermain() {
    Get.to(() => const CaraBermainPage());
  }

  void _navigateToTips() {
    Get.to(() => const TipsTrikPage());
  }

  @override
  Widget build(BuildContext context) {
    if (_isLoading) {
      return const Scaffold(body: Center(child: CircularProgressIndicator()));
    }

    final screenWidth = MediaQuery.of(context).size.width;
    final screenHeight = MediaQuery.of(context).size.height;

    return Scaffold(
      body: Stack(
        children: [
          Image.asset(
            'assets/images/Bg.jpg',
            fit: BoxFit.cover,
            height: double.infinity,
            width: double.infinity,
            errorBuilder: (context, error, stackTrace) {
              return Container(
                color: Colors.brown.shade300,
                child: const Center(
                  child: Icon(Icons.error, size: 50, color: Colors.red),
                ),
              );
            },
          ),
          SafeArea(
            child: Column(
              children: [
                _buildHeader(),
                const SizedBox(height: 30),
                Expanded(
                  child: SingleChildScrollView(
                    padding: EdgeInsets.symmetric(horizontal: screenWidth * 0.08),
                    child: Column(
                      children: [
                        _AnimatedMenuButton(
                          imagePath: 'assets/buttons/BtnCaraBermain.png',
                          onTap: _navigateToCaraBermain,
                        ),
                        SizedBox(height: screenHeight * 0.025),
                        _AnimatedMenuButton(
                          imagePath: 'assets/buttons/BtnTips.png',
                          onTap: _navigateToTips,
                        ),
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

class _AnimatedMenuButton extends StatefulWidget {
  final String imagePath;
  final VoidCallback onTap;

  const _AnimatedMenuButton({
    required this.imagePath,
    required this.onTap,
  });

  @override
  State<_AnimatedMenuButton> createState() => _AnimatedMenuButtonState();
}

class _AnimatedMenuButtonState extends State<_AnimatedMenuButton> {
  bool _isPressed = false;

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTapDown: (_) => setState(() => _isPressed = true),
      onTapUp: (_) {
        setState(() => _isPressed = false);
        widget.onTap();
      },
      onTapCancel: () => setState(() => _isPressed = false),
      child: AnimatedScale(
        scale: _isPressed ? 0.95 : 1.0,
        duration: const Duration(milliseconds: 100),
        curve: Curves.easeInOut,
        child: Image.asset(
          widget.imagePath,
          width: double.infinity,
          fit: BoxFit.contain,
          errorBuilder: (context, error, stackTrace) {
            return Container(
              height: 120,
              decoration: BoxDecoration(
                gradient: const LinearGradient(
                  colors: [
                    Color(0xFFD4A574),
                    Color(0xFFB8895C),
                    Color(0xFFA67C52),
                  ],
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                ),
                borderRadius: BorderRadius.circular(25),
                border: Border.all(
                  color: const Color(0xFF8B6F47),
                  width: 3,
                ),
                boxShadow: [
                  BoxShadow(
                    color: Colors.brown.shade900.withValues(alpha: 0.4),
                    blurRadius: 10,
                    offset: const Offset(0, 5),
                  ),
                ],
              ),
              child: Center(
                child: Text(
                  widget.imagePath.contains('CaraBermain')
                      ? 'Cara Bermain Puzzle'
                      : 'Tips dan Trik',
                  style: TextStyle(
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                    color: Colors.brown.shade900,
                  ),
                ),
              ),
            );
          },
        ),
      ),
    );
  }
}
