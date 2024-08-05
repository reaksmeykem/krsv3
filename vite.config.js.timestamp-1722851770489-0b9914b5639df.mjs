// vite.config.js
import { defineConfig } from "file:///D:/2024/Projects/bigapp/node_modules/vite/dist/node/index.js";
import laravel from "file:///D:/2024/Projects/bigapp/node_modules/laravel-vite-plugin/dist/index.js";
import path from "path";
var __vite_injected_original_dirname = "D:\\2024\\Projects\\bigapp";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true,
      buildDirectory: "public/build"
    })
  ],
  build: {
    manifest: true,
    outDir: path.resolve(__vite_injected_original_dirname, "public/build"),
    // Ensure this line is correct
    rollupOptions: {
      input: {
        app: "resources/js/app.js",
        style: "resources/css/app.css"
      }
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJEOlxcXFwyMDI0XFxcXFByb2plY3RzXFxcXGJpZ2FwcFwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiRDpcXFxcMjAyNFxcXFxQcm9qZWN0c1xcXFxiaWdhcHBcXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0Q6LzIwMjQvUHJvamVjdHMvYmlnYXBwL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCBwYXRoIGZyb20gJ3BhdGgnO1xuXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogWydyZXNvdXJjZXMvY3NzL2FwcC5jc3MnLCAncmVzb3VyY2VzL2pzL2FwcC5qcyddLFxuICAgICAgICAgICAgcmVmcmVzaDogdHJ1ZSxcbiAgICAgICAgICAgIGJ1aWxkRGlyZWN0b3J5OiAncHVibGljL2J1aWxkJyxcbiAgICAgICAgfSksXG4gICAgXSxcbiAgICBidWlsZDoge1xuICAgICAgICBtYW5pZmVzdDogdHJ1ZSxcbiAgICAgICAgb3V0RGlyOiBwYXRoLnJlc29sdmUoX19kaXJuYW1lLCAncHVibGljL2J1aWxkJyksICAvLyBFbnN1cmUgdGhpcyBsaW5lIGlzIGNvcnJlY3RcbiAgICAgICAgcm9sbHVwT3B0aW9uczoge1xuICAgICAgICAgICAgaW5wdXQ6IHtcbiAgICAgICAgICAgICAgICBhcHA6ICdyZXNvdXJjZXMvanMvYXBwLmpzJyxcbiAgICAgICAgICAgICAgICBzdHlsZTogJ3Jlc291cmNlcy9jc3MvYXBwLmNzcycsXG4gICAgICAgICAgICB9LFxuICAgICAgICB9LFxuICAgIH0sXG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBK1AsU0FBUyxvQkFBb0I7QUFDNVIsT0FBTyxhQUFhO0FBQ3BCLE9BQU8sVUFBVTtBQUZqQixJQUFNLG1DQUFtQztBQUl6QyxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSixPQUFPLENBQUMseUJBQXlCLHFCQUFxQjtBQUFBLE1BQ3RELFNBQVM7QUFBQSxNQUNULGdCQUFnQjtBQUFBLElBQ3BCLENBQUM7QUFBQSxFQUNMO0FBQUEsRUFDQSxPQUFPO0FBQUEsSUFDSCxVQUFVO0FBQUEsSUFDVixRQUFRLEtBQUssUUFBUSxrQ0FBVyxjQUFjO0FBQUE7QUFBQSxJQUM5QyxlQUFlO0FBQUEsTUFDWCxPQUFPO0FBQUEsUUFDSCxLQUFLO0FBQUEsUUFDTCxPQUFPO0FBQUEsTUFDWDtBQUFBLElBQ0o7QUFBQSxFQUNKO0FBQ0osQ0FBQzsiLAogICJuYW1lcyI6IFtdCn0K
